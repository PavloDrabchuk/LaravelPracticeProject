<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Jobs\BuyToursJob;
use App\Jobs\CartJob;
use App\Jobs\UpdateProductQuantityJob;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/carts",
     *     operationId="allCarts",
     *     tags={"Cart"},
     *     summary="Get carts information",
     *     description="Returns carts data by id",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     *
     * Display a listing of the resource.
     *
     * @return Cart[]|Collection|Response
     */
    public function index()
    {
        return Cart::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return int
     */
    public function store(Request $request)
    {
        if (Auth::guard('sanctum')->check()) {
            return Cart::create([
                'user_id' => auth('sanctum')->user()->getKey(),
            ]);
        }
    }

    /**
     *
     * @OA\Get(
     *     path="/cart",
     *     operationId="userCart",
     *     tags={"Cart"},
     *     summary="Get user cart information",
     *     description="Returns user cart data",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     *
     * Display the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return Response
     */
    public function show(Cart $cart)
    {
        $userId = auth('sanctum')->user()->getKey();
        $cart = Cart::where('user_id', $userId)->first();

        return ($cart)
            ? response(new CartResource($cart), 200)
            : response(['message' => ['Cart not yet created.']], 404);
    }

    /**
     *
     * @OA\Delete(
     *     path="/cart",
     *     operationId="deleteCart",
     *     tags={"Cart"},
     *     summary="Delete user cart",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response="200",
     *         description="Deleted",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @return string
     * @throws \Exception
     */
    public function destroy()
    {
        $userId = auth('sanctum')->user()->getKey();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            CartItem::whereCartId($cart->id)->delete();

            return response(['message' => ['Cart cleared.']], 200);
        } else {
            return response(['message' => ['Cart not found.']], 404);
        }
    }

    /**
     *
     * @OA\Get(
     *     path="/cart/checkout",
     *     operationId="checkout",
     *     tags={"Cart"},
     *     description="Making an order to purchase tours.",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      )
     *     )
     *
     * @return Application|ResponseFactory|Response
     */
    public function buyTours()
    {
        $userId = auth('sanctum')->user()->getKey();
        $cart = Cart::where('user_id', $userId)->first();

        if ($this->checkQuantity($cart) && CartItem::whereCartId($cart->id)->first()) {

            UpdateProductQuantityJob::dispatchSync($cart);

            CartJob::dispatch($cart)
                ->onQueue('emails');

            return response(["message" => "Tours purchased successfully."], 200);
        } else {
            return response(["message" => "These tours are over."], 400);
        }
    }

    private function checkQuantity($cart)
    {
        $checkQuantity = true;

        foreach ($cart->cartItems as $cartItem) {
            if ((Product::whereId($cartItem->product_id)->first()->quantity - $cartItem->quantity) < 0) {
                $checkQuantity = false;
                break;
            }
        }

        return $checkQuantity;
    }
}

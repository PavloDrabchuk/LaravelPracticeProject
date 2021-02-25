<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Jobs\CartJob;
use App\Mail\ToursBoughtMail;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;


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
     * @param \Illuminate\Http\Request $request
     * @return int
     */
    public function store(Request $request)
    {
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        if ($userId != -1) {
            Cart::create([
                'user_id' => $userId,
            ]);
            return 1;
        }
        return 0;
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
        return ($cart) ? response(new CartResource($cart), 200) : response(
            ['message' => ['Cart not yet created.']], 404);
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
     */
    public function destroy()
    {
        $userId = auth('sanctum')->user()->getKey();
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cart->delete();

            Cart::create([
                'user_id' => $userId,
            ])->save();

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

        $checkQuantity = true;
        foreach ($cart->cartItems as $cartItem) {
            if ((Product::whereId($cartItem->product_id)->first()->quantity - $cartItem->quantity) < 0) {
                $checkQuantity = false;
                break;
            }
        }

        if ($checkQuantity && CartItem::whereCartId($cart->id)->count() > 0) {
            foreach ($cart->cartItems as $cartItem) {
                $quantity = Product::whereId($cartItem->product_id)->first()->quantity;

                Product::whereId($cartItem->product_id)->update([
                    'quantity' => $quantity - $cartItem->quantity,
                ]);
            }
        } else {
            return response([
                "message" => "These tours are over."
            ], 400);
        }

        CartJob::dispatch($cart)
            ->onQueue('emails');



        return response(["message" => "Tours purchased successfully."], 200);
    }


}

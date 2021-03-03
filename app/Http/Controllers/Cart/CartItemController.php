<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Jobs\StoreCartItemJob;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     *
     * @OA\Post(
     *      path="/cart/add_item",
     *      operationId="addItem",
     *      tags={"Cart"},
     *      summary="Add product to cart",
     *      description="Add product to cart",
     *     security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Input product information",
     *          @OA\JsonContent(
     *          type="object",
     *          required={"product_id","quantity"},
     *          @OA\Property(property="product_id", type="integer" , example="1"),
     *          @OA\Property(property="quantity", type="integer" , example="1")
     *    ),
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('sanctum')->check()) {
            $userId = Auth::guard('sanctum')->user()->getKey();

            $cart = Cart::where('user_id', $userId)->firstOrCreate([
                'user_id' => $userId,
            ]);
        }

        $productIdValidate = Validator::make($request->json()->all(), [
            'product_id' => ['required', 'numeric', 'min:1', 'exists:tours,id',
                Rule::notIn(array_column(CartItem::where('cart_id', '=', $cart->id)
                    ->get()
                    ->toArray(), 'product_id')),
            ],
        ]);

        if ($productIdValidate->fails()) return response($productIdValidate->errors(), 400);

        $maxQuantity = Product::where('id', $request->input('product_id'))->first()->quantity;

        $quantityValidate = Validator::make($request->json()->all(), [
            'quantity' => ['required', 'numeric', 'min:1',
                "max:$maxQuantity"],
        ]);

        if ($quantityValidate->fails()) return response($quantityValidate->errors(), 400);

        StoreCartItemJob::dispatchSync($request->all(), $cart);

        return response(["message" => "Product added to cart."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CartItem $cartItem
     * @return Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\CartItem $cartItem
     * @return Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     *
     * @OA\Delete(
     *     path="/cart/item/{id}",
     *     operationId="deleteCartItem",
     *     tags={"Cart"},
     *     summary="Delete cart item",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Cart item id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Deleted",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad request",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        $userId = Auth::guard('sanctum')->user()->getKey();
        $cart = Cart::whereUserId($userId)->first();

        if (count(CartItem::whereCartId($cart->id)->whereId($id)->get())) {
            CartItem::whereId($id)->delete();

            return response(["message" => "Deleted."], 200);
        } else {
            return response(["message" => "Cart item not found."], 400);
        }
    }
}

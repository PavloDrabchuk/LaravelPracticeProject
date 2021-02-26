<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            Cart::create([
                'user_id' => $userId,
            ])->save();
            $cart = Cart::where('user_id', $userId)->first();
        }

        $validator = Validator::make($request->json()->all(), [
            'product_id' => ['required', 'numeric', 'min:1', 'exists:tours,id',
                Rule::notIn(array_column(CartItem::all()
                    ->where('cart_id', '=', $cart->id)
                    ->toArray(), 'product_id')),
            ],
            'quantity' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) return response($validator->errors(), 400);

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
        ]);

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
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CartItem $cartItem
     * @return Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}

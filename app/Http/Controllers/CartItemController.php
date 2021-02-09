<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            /*$userId = -1;
            if (Auth::guard('sanctum')->check()) {
                $userId = auth('sanctum')->user()->getKey();
            }*/

            Cart::create([
                'user_id' => $userId,
            ])->save();
        }

        //if ($cart) {
            /*$newProduct = [
                'product_id' => $product_id,
                'quantity' => $quantity];

            $products = $cart->products;
            $products[] = $newProduct;
            $cart->products = $products;
            $cart->save();*/
            $validator = Validator::make($request->json()->all(), [
                'product_id' => 'required|numeric|min:1',
                'quantity' => 'required|numeric|min:1|max:10',
            ]);

            if ($validator->fails()) return response($validator->errors(), 400);

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),
            ]);

            //return $cart;
            return response(["message" => "Product added to cart."], 200);
       // }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CartItem $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CartItem $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CartItem $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}

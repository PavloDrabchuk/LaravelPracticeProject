<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function addProducts(Request $request)
    {
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        $request->validate([
            'product_id' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1|max:10',
        ]);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = Cart::where('user_id', $userId)->first();
        if ($cart) {
            $newProduct = [
                'product_id' => $product_id,
                'quantity' => $quantity];

            $products = $cart->products;
            $products[] = $newProduct;
            $cart->products = $products;
            $cart->save();

            //return $cart;
        } else {
            Cart::create([
                'user_id' => $userId,
                'products' => [
                    [
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ],
                ],
            ]);
        }
    }
}

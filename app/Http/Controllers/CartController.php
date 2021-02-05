<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        return ($cart) ? response($cart, 200) : response(
            ['message' => ['Cart not yet created.']], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cart $cart
     * @return Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    /**
     *
     * @OA\Post(
     *      path="/cart/add_product",
     *      operationId="addProduct",
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function addProducts(Request $request)
    {
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        $validator = Validator::make($request->json()->all(), [
            'product_id' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1|max:10',
        ]);

        if ($validator->fails()) return response($validator->errors(), 400);


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
            return response(["message" => "Product added to cart."], 200);
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

            return response(["message" => "Cart created and product added."], 200);
        }
    }
}

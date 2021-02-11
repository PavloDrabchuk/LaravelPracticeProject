<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
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
        $userId = -1;
        if (Auth::guard('sanctum')->check()) {
            $userId = auth('sanctum')->user()->getKey();
        }

        Cart::create([
            'user_id' => $userId,
        ]);
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
        return ($cart) ? response( new CartResource($cart), 200) : response(
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


}

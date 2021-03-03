<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public static $wrap = 'carts';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->whenLoaded('id'),
            'user_id' => $this->whenLoaded('user_id'),
            'items' => CartItemResource::collection($this->whenLoaded('cartItems')),
        ];
    }
}

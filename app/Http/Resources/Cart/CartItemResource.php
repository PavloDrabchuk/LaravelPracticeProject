<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
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
            'product' => new ProductResource(
                Product::findOrFail($this->whenLoaded('product_id'))),
            'quantity' => $this->whenLoaded('quantity'),
        ];
    }
}

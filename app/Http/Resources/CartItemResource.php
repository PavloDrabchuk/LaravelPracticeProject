<?php

namespace App\Http\Resources;

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
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            //'product_id' => $this->product_id,
            'product'=>new ProductResource(Product::findOrFail($this->product_id)),
            'quantity' => $this->quantity,
        ];
    }
}

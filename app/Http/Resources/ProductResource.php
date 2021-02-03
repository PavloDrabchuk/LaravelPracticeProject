<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->getTranslations('name'),
            'category'=>$this->category,
            'quantity'=>$this->quantity,
            'article'=>$this->article,
            'color'=>$this->color,
            'price'=>$this->price,
        ];
    }
}

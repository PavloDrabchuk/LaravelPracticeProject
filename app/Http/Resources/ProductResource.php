<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Color;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = 'products';

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'category' => new CategoryResource(Category::findOrFail($this->category_id)),
            'quantity' => $this->quantity,
            'article' => $this->article,
            'color' => new ColorResource(Color::findOrFail($this->color_id)),
            'price' => new PriceResource(Price::findOrFail($this->price_id)),
        ];
    }
}
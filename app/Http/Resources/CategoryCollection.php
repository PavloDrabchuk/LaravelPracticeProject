<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryCollection extends ResourceCollection
{
    public static $wrap = 'categories';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return Collection
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->getTranslations('name'),
                'products' => ProductResource::collection($item->products),
            ];
        });
    }
}

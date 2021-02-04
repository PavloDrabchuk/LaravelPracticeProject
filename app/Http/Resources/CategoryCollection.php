<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryCollection extends ResourceCollection
{
    public static $wrap = 'categories';

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Collection
     *
     * @OA\Get(
     *     path="/categories",
     *     operationId="allCategories",
     *     tags={"Get"},
     *     summary="Get all categories",
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
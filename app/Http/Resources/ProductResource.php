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
     *
     * @OA\Get(
     *      path="/products/{id}",
     *      operationId="getProductById",
     *      tags={"Product"},
     *      summary="Get product information by id",
     *      description="Returns product data by id",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
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

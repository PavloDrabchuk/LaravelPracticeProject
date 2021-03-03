<?php

namespace App\Http\Resources\Price;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->whenLoaded('id'),
            'value' => $this->whenLoaded('value'),
            'currency' => new CurrencyResource(Currency::findOrFail($this->getAttribute('currency_id'))),
        ];

    }
}

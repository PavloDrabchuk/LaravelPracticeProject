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
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'value'=>$this->value,
            'currency'=>new CurrencyResource(Currency::findOrFail($this->currency_id)),
        ];

    }
}

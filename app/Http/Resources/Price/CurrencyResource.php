<?php

namespace App\Http\Resources\Price;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
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
            'code' => $this->whenLoaded('code'),
            'sign' => $this->whenLoaded('sign'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nameUA' => ['required', 'string', 'max:60'],
            'nameEN' => ['required', 'string', 'max:60'],
            'nameRU' => ['required', 'string', 'max:60'],
            'category' => ['required'],
            'quantity' => ['required', 'min:0', 'numeric'],
            'article' => ['required'],
            'color' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }
}

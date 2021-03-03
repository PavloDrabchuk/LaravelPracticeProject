<?php

namespace App\Http\Requests;

use App\Models\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest
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
        $currencyCodes = (new Currency)->getAllPossibleCurrencyCode();

        return [
            'code' => [
                'required', 'string', 'max:3',
                Rule::in($currencyCodes)],
            'sign' => ['required', 'string', 'max:1'],
        ];
    }
}

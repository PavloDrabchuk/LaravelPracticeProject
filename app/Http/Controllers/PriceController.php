<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PriceController extends Controller
{
    /**
     * @param $value
     * @param Product $product
     * @param $action
     */
    public function convert($value, Product $product, $action)
    {
        if ($action == "create") {
            Price::create([
                'value' => $value,
                'currency_id' => 1,
                'product_id' => $product->id,
            ]);
        } else if ($action == "update") {
            $product->prices()->where('currency_id', '=', 1)->update([
                'value' => round($value, 2),
                'currency_id' => 1,
                'product_id' => $product->id,
            ]);
        }

        $exchangeRate = file_get_contents(env('BANK_EXCHANGE_URL'));
        $exchange = json_decode($exchangeRate, true);

        $currencyCodes = Currency::all()->where('code', '!=', "UAH");

        foreach ($currencyCodes as $currency) {
            $key = array_search($currency->code, array_column($exchange, 'cc'));
            if ($key) {
                $newValue = $value / $exchange[$key]['rate'];
                if ($action == "create") {

                    Price::create([
                        'value' => round($newValue, 2),
                        'currency_id' => $currency->id,
                        'product_id' => $product->id,
                    ]);
                } else if ($action == "update") {
                    $product->prices()->where('currency_id', '=', $currency->id)->updateOrCreate([
                        'currency_id' => $currency->id,
                        'product_id' => $product->id,
                    ], ['value' => round($newValue, 2)]);
                }
            }
        }
    }
}

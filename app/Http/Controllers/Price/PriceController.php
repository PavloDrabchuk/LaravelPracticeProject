<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Jobs\Price\StorePriceJob;
use App\Jobs\Price\UpdatePriceJob;
use App\Models\Currency;
use App\Models\Product;

class PriceController extends Controller
{
    /**
     * @param $value
     * @param Product $product
     * @param $action
     */
    public function convert($value, Product $product, $action)
    {
        $action == "create"
            ? StorePriceJob::dispatchSync($value, 1, $product->id)
            : UpdatePriceJob::dispatchSync(round($value, 2), 1, $product);

        $exchangeRate = file_get_contents(env('BANK_EXCHANGE_URL'));
        $exchange = json_decode($exchangeRate, true);

        $currencyCodes = Currency::where('code', '!=', "UAH")->get();

        foreach ($currencyCodes as $currency) {
            $key = array_search($currency->code, array_column($exchange, 'cc'));

            if ($key) {
                $newValue = $value / $exchange[$key]['rate'];

                $action == "create"
                    ? StorePriceJob::dispatchSync(round($newValue, 2), $currency->id, $product->id)
                    : UpdatePriceJob::dispatchSync(round($newValue, 2), $currency->id, $product);
            }
        }
    }
}

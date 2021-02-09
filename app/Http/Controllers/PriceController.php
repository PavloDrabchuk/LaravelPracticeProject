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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Price $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
    }

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
                    //$product->prices()->where('currency_id','=', $currency->id)->update([
                    $product->prices()->where('currency_id', '=', $currency->id)->updateOrCreate([
                        //$product->prices()->updateOrCreate([
                        'currency_id' => $currency->id,
                        'product_id' => $product->id,
                    ], ['value' => round($newValue, 2)]);
                }
            }
        }
    }
}

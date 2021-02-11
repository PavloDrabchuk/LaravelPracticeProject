<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $currencyCodes = (new Currency)->getAllPossibleCurrencyCode();
        return view('currencies.create', compact('currencyCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $currencyCodes = (new Currency)->getAllPossibleCurrencyCode();

        $request->validate([
            'code' => [
                'required', 'string', 'max:3', 'unique:currencies',
                Rule::in($currencyCodes)],
            'sign' => 'required|string|max:1',
        ]);

        Currency::create([
            'code' => $request->input('code'),
            'sign' => $request->input('sign'),
        ]);

        return redirect()->route('currencies.index')
            ->with('ok', 'Currency successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param Currency $currency
     * @return Application|Factory|View|Response
     */
    public function show(Currency $currency)
    {
        return view('currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Currency $currency
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Currency $currency)
    {
        if($currency->code=='UAH'){
            return redirect()->route('currencies.index')
                ->with('alert', 'This currency cannot be changed.');
        }
        $currencyCodes = (new Currency)->getAllPossibleCurrencyCode();
        return view('currencies.edit',
            compact('currencyCodes'),
            compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function update(Request $request, Currency $currency)
    {
        $currencyCodes = (new Currency)->getAllPossibleCurrencyCode();

        $request->validate([
            'code' => [
                'required', 'string', 'max:3', 'unique:currencies',
                Rule::in($currencyCodes)],
            'sign' => 'required|string|max:1',
        ]);

        $currency->update([
            'code' => $request->input('code'),
            'sign' => $request->input('sign'),
        ]);

        return redirect()->route('currencies.index')
            ->with('ok', 'Currency successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Currency $currency)
    {
        if($currency->code=='UAH'){
            return redirect()->route('currencies.index')
                ->with('alert', 'This currency cannot be deleted.');
        }

        $currency->delete();

        return redirect()->route('currencies.index')
            ->with('ok', 'Currency successfully deleted');
    }
}

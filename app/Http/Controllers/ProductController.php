<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Price;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nameUA' => 'required|string|max:60',
            'nameEN' => 'required|string|max:60',
            'nameRU' => 'required|string|max:60',
            'category' => 'required',
            'quantity' => 'required|min:0|numeric',
            'article' => 'required',
            'color' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
        ]);

        $color = Color::create([
            'name' => $request->input('color'),
        ]);

        $price = Price::create([
            'value' => $request->input('price'),
        ]);

        Product::create([

            'name' => [
                'ua' => $request->input('nameUA'),
                'en' => $request->input('nameEN'),
                'ru' => $request->input('nameRU'),
            ],
            'category_id' => $request->get('category'),
            'quantity' => $request->input('quantity'),
            'article' => $request->input('article'),
            'color_id' => $color->id,
            'price_id' => $price->id,
        ]);

        return redirect()->route('products.index')
            ->with('ok', 'Product successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View|Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View|Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('products.edit',
            compact('product'),
            compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @param Color $color
     * @param Price $price
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nameUA' => 'required|string|max:60',
            'nameEN' => 'required|string|max:60',
            'nameRU' => 'required|string|max:60',
            'category' => 'required',
            'quantity' => 'required|min:0|numeric',
            'article' => 'required',
            'color' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
        ]);

        $product->color()->update([
            'name' => $request->input('color'),
        ]);

        $product->price()->update([
            'value' => $request->input('price'),
        ]);

        $product->update([
            'name' => [
                'ua' => $request->input('nameUA'),
                'en' => $request->input('nameEN'),
                'ru' => $request->input('nameRU'),
            ],
            'category_id' => $request->get('category'),
            'quantity' => $request->input('quantity'),
            'article' => $request->input('article'),
        ]);

        return redirect()->route('products.index')
            ->with('ok', 'Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $product->color()->delete();
        $product->price()->delete();

        return redirect()->route('products.index')
            ->with('ok', 'Product successfully deleted');
    }
}
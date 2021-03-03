<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAndUpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Jobs\StoreProductJob;
use App\Jobs\UpdateProductJob;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $products = Product::all();
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
     * @param StoreAndUpdateProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAndUpdateProductRequest $request)
    {
        StoreProductJob::dispatchSync($request->validated());

        return redirect()
            ->route('products.index')
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
        $categories = Category::all();

        return view('products.edit',
            compact('product'),
            compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAndUpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(StoreAndUpdateProductRequest $request, Product $product)
    {
        UpdateProductJob::dispatchSync($request->validated(), $product);

        return redirect()
            ->route('products.index')
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

        return redirect()
            ->route('products.index')
            ->with('ok', 'Product successfully deleted');
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllProducts()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * @param $id
     * @return ProductResource
     */
    public function getProductById($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }
}

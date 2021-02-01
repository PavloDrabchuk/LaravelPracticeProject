<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('categories.create');
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
        ]);

        Category::create([
            'name' => [
                'ua' => $request->nameUA,
                'en' => $request->nameEN,
                'ru' => $request->nameRU,
            ],
        ]);

        return redirect()->route('categories.index')
            ->with('ok', 'Category successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View|Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View|Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nameUA' => 'required|string|max:60',
            'nameEN' => 'required|string|max:60',
            'nameRU' => 'required|string|max:60',
        ]);

        $category->update([
            'name' => [
                'ua' => $request->nameUA,
                'en' => $request->nameEN,
                'ru' => $request->nameRU,
            ],
        ]);

        return redirect()->route('categories.index')
            ->with('ok', 'Category successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('ok', 'Category successfully deleted.');
    }
}

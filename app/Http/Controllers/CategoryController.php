<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\DestroyCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno kreirana.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Ako kategorija ima oglase, validacija se dešava u DestroyCategoryRequest.
        if ($category->ads()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Ne možete uređivati kategoriju jer ima povezane oglase.');
        }

        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno ažurirana.');
    }

    public function destroy(DestroyCategoryRequest $request, Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno obrisana.');
    }
}

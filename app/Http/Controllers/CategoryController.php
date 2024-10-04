<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno kreirana.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        // Ako kategorija ima oglase, zabrani brisanje
        if ($category->ads()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Ne možete uređivati kategoriju jer ima povezane oglase.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno ažurirana.');
    }

    public function destroy(Category $category)
    {
        // Ako kategorija ima oglase, zabrani brisanje
        if ($category->ads()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Ne možete obrisati kategoriju jer ima povezane oglase.');
        }

        // Ako nema oglasa, obriši kategoriju
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategorija uspešno obrisana.');
    }
}


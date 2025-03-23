<?php

namespace App\Http\Controllers\Peinture;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peinture\CategoryRequest;
use App\Models\Peinture\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Peinture/category/Index', [
            'categories' => Category::all(['id', 'name', 'description'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->back()->with('success', 'Catégorie ajoutée!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return redirect()->back()->with('success', 'Catégorie modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->ingredients()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cette catégorie car elle est utilisée par des ingrédients.');
            return;
        }
        $category->delete();
        return redirect()->back()->with('success', 'Catégorie supprimée!');
    }
}

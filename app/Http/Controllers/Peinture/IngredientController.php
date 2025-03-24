<?php

namespace App\Http\Controllers\Peinture;

use App\Http\Requests\Peinture\IngredientRequest;
use Inertia\Inertia;
use App\Models\Peinture\Category;
use App\Models\Peinture\Ingredient;
use App\Http\Controllers\Controller;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Peinture/ingredient/Index', [
            'ingredients' => Ingredient::with('category')->get(),
            'categories' => Category::all(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IngredientRequest $request)
    {
        Ingredient::create($request->validated());
        return redirect()->back()->with('success', 'Ingrédient ajouté!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngredientRequest $request, string $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->validated());
        return redirect()->back()->with('success', 'Ingrédient modifié!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (Ingredient::findOrFail($id))->delete();
        return redirect()->back()->with('success', 'Ingrédient supprimé!');
    }
}

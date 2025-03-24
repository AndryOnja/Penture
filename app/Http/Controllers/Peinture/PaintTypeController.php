<?php

namespace App\Http\Controllers\Peinture;

use App\Http\Requests\Peinture\PaintTypeRequest;
use App\Models\Peinture\PaintType;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Peinture/paintType/Index', [
            'paintTypes' => PaintType::all(['id', 'name', 'description'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaintTypeRequest $request)
    {
        PaintType::create($request->validated());
        return redirect()->back()->with('success', 'Type de peinture ajoutée!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaintTypeRequest $request, string $id)
    {
        $paintType = PaintType::findOrFail($id);
        $paintType->update($request->validated());
        return redirect()->back()->with('success', 'Type de peinture modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paintType = PaintType::findOrFail($id);
        if ($paintType->formulas()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer ce type de peinture car elle est utilisée par des formules.');
            return;
        }
        $paintType->delete();
        return redirect()->back()->with('success', 'Type de peinture supprimée!');
    }
}

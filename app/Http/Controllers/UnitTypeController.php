<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Transporte/UnitType/Index', [
            'data' => UnitType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $store = UnitType::create($request->all());

        if (!$store) {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Error.',
                'type' => 'error',
            ]);
        } else {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Unidad creada correctamente.',
                'type' => 'success',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitType $unitType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitType $unitType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitType $unitType)
    {
        //
        $request->validate([
            'name' => ['required'],
        ]);

        $update = $unitType->update($request->all());

        if (!$update) {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Error.',
                'type' => 'error',
            ]);
        } else {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Unidad actualizada correctamente.',
                'type' => 'success',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitType $unitType)
    {
        $delete = $unitType->delete();

        if (!$delete) {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Error.',
                'type' => 'error',
            ]);
        } else {
            return redirect()->route('unit-type.index')->with([
                'message' => 'Unidad eliminada correctamente.',
                'type' => 'success',
            ]);
        }
    }
}

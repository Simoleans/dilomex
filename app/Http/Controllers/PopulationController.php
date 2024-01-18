<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Population/Index', [
            'data' => Population::orderBy('id', 'desc')->get()
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
            'name' => ['required', 'max:255']
        ]);

        $store = Population::create($request->all());

        if (!$store) {
            return redirect()->route('populations.index')->with([
                'message' => '¡Error al crear la población!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('populations.index')->with([
                'message' => 'Población creada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Population $population)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Population $population)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Population $population)
    {
        //
        $request->validate([
            'name' => ['required', 'max:255']
        ]);

        $update = $population->update($request->all());

        if (!$update) {
            return redirect()->route('populations.index')->with([
                'message' => '¡Error al actualizar la población!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('populations.index')->with([
                'message' => 'Población actualizada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Population $population)
    {
        $delete = $population->delete();

        if (!$delete) {
            return redirect()->route('populations.index')->with([
                'message' => '¡Error al eliminar la población!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('populations.index')->with([
                'message' => 'Población eliminada correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

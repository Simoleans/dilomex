<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Conceptos/Distribution/Index', [
            'data' => Distribution::orderBy('id', 'desc')->get()
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

        $store = Distribution::create($request->all());

        if (!$store) {
            return redirect()->route('distributions.index')->with([
                'message' => '¡Error al crear el reparto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('distributions.index')->with([
                'message' => 'Reparto creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Distribution $distribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distribution $distribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distribution $distribution)
    {
        request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $update = $distribution->update($request->all());

        if (!$update) {
            return redirect()->route('distributions.index')->with([
                'message' => '¡Error al actualizar el reparto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('distributions.index')->with([
                'message' => 'Reparto actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribution $distribution)
    {
        $delete = $distribution->delete();

        if (!$delete) {
            return redirect()->route('distributions.index')->with([
                'message' => '¡Error al eliminar el reparto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('distributions.index')->with([
                'message' => 'Reparto eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

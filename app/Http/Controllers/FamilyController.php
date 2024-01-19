<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Tarifas\Family;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Tarifas/Family/Index', [
            'data' =>  Family::orderBy('id','DESC')->get()
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
                'name' => 'required',
            ]);

            $store = Family::create($request->all());

            if (!$store) {
                return redirect()->route('families.index')->with([
                    'message' => '¡Error al crear Familia!',
                    'type' => 'error'
                ]);
            } else {
                return redirect()->route('families.index')->with([
                    'message' => 'Familia creada correctamente!',
                    'type' => 'success'
                ]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $update = $family->update($request->all());

        if (!$update) {
            return redirect()->route('families.index')->with([
                'message' => '¡Error al actualizar Familia!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('families.index')->with([
                'message' => 'Familia actualizada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $delete = $family->delete();

        if (!$delete) {
            return redirect()->route('families.index')->with([
                'message' => '¡Error al eliminar Familia!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('families.index')->with([
                'message' => 'Familia eliminada correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Tarifas\KilometerCost;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Location;

class KilometerCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Tarifas/KilometerCost/Index', [
            'data' =>  KilometerCost::with('location')->orderBy('id','DESC')->get(),
            'locations' => Location::orderBy('id','DESC')->get()
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
                    'location_id' => 'required',
                    'cost' => 'required',
                ]);

                $store = KilometerCost::create($request->all());

                if (!$store) {
                    return redirect()->route('kilometer-cost.index')->with([
                        'message' => '¡Error al crear Tarifa por Kilometro!',
                        'type' => 'error'
                    ]);
                } else {
                    return redirect()->route('kilometer-cost.index')->with([
                        'message' => 'Tarifa por Kilometro creada correctamente!',
                        'type' => 'success'
                    ]);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(KilometerCost $kilometerCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KilometerCost $kilometerCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KilometerCost $kilometerCost)
    {
        $request->validate([
            'location_id' => 'required',
            'cost' => 'required',
        ]);

        $update = $kilometerCost->update($request->all());

        if (!$update) {
            return redirect()->route('kilometer-cost.index')->with([
                'message' => '¡Error al actualizar Tarifa por Kilometro!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('kilometer-cost.index')->with([
                'message' => 'Tarifa por Kilometro actualizada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KilometerCost $kilometerCost)
    {
        $delete = $kilometerCost->delete();

        if (!$delete) {
            return redirect()->route('kilometer-cost.index')->with([
                'message' => '¡Error al eliminar Tarifa por Kilometro!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('kilometer-cost.index')->with([
                'message' => 'Tarifa por Kilometro eliminada correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

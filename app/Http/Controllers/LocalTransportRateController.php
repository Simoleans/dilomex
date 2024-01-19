<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Tarifas\LocalTransportRate;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Distribution, UnitType};

class LocalTransportRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Tarifas/LocalTransportRates/Index', [
            'data' => LocalTransportRate::with('distribution', 'uniType')->orderBy('id','DESC')->get(),
            'distributions' => Distribution::all(),
            'uniTypes' => UnitType::all(),
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
            'distribution_id' => 'required',
            'uni_type_id' => 'required',
            'cost' => 'required',
        ]);

        $store = LocalTransportRate::create($request->all());

        if (!$store) {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡Error al crear la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡la tarifa se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalTransportRate $localTransportRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocalTransportRate $localTransportRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocalTransportRate $localTransportRate)
    {
        //
        $request->validate([
            'distribution_id' => 'required',
            'uni_type_id' => 'required',
            'cost' => 'required',
        ]);

        $update = $localTransportRate->update($request->all());

        if (!$update) {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡Error al actualizar la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡la tarifa se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalTransportRate $localTransportRate)
    {
        $delete = $localTransportRate->delete();

        if (!$delete) {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡Error al eliminar la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('local-transport-rates.index')->with([
                'message' => '¡la tarifa se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Tarifas\CompanyTravel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\{Population, UnitType};


class CompanyTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Tarifas/CompanyTravel/Index', [
            'data' => CompanyTravel::with('population', 'uniType')->orderBy('id','DESC')->get(),
            'populations' => Population::all(),
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
            'population_id' => 'required',
            'uni_type_id' => 'required',
            'cost' => 'required',
        ]);

        $store = CompanyTravel::create($request->all());

        if (!$store) {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡Error al crear la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡la tarifa se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyTravel $companyTravel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyTravel $companyTravel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyTravel $companyTravel)
    {
        $request->validate([
            'population_id' => 'required',
            'uni_type_id' => 'required',
            'cost' => 'required',
        ]);

        $update = $companyTravel->update($request->all());

        if (!$update) {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡Error al actualizar la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡la tarifa se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyTravel $companyTravel)
    {
        $delete = $companyTravel->delete();

        if (!$delete) {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡Error al eliminar la tarifa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('company-travel.index')->with([
                'message' => '¡la tarifa se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

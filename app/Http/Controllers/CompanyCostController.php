<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Tarifas\CompanyCost;
use App\Models\{Company, Location};
use Illuminate\Http\Request;

class CompanyCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Catalogo/Tarifas/CompanyCost/Index', [
            'data' => CompanyCost::with('company', 'location')->orderBy('id','DESC')->get(),
            'locations' => Location::orderBy('name')->get(),
            'companies' => Company::orderBy('name')->get(),
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
                    'company_id' => 'required',
                    'location_id' => 'required',
                    'cost' => 'required',
                    'type' => 'required',
                ],
                [
                    'company_id.required' => 'El campo Empresa es obligatorio.',
                    'location_id.required' => 'El campo Ubicación es obligatorio.',
                    'cost.required' => 'El campo Costo es obligatorio.',
                    'type.required' => 'El campo Tipo es obligatorio.',
                ]);

                $store = CompanyCost::create($request->all());

                if (!$store) {
                    return redirect()->route('company-cost.index')->with([
                        'message' => '¡Error al crear Tarifa por Empresa!',
                        'type' => 'error'
                    ]);
                } else {
                    return redirect()->route('company-cost.index')->with([
                        'message' => 'Tarifa por Empresa creada correctamente!',
                        'type' => 'success'
                    ]);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyCost $companyCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyCost $companyCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyCost $companyCost)
    {
        $request->validate([
            'company_id' => 'required',
            'location_id' => 'required',
            'cost' => 'required',
            'type' => 'required',
        ],
        [
            'company_id.required' => 'El campo Empresa es obligatorio.',
            'location_id.required' => 'El campo Ubicación es obligatorio.',
            'cost.required' => 'El campo Costo es obligatorio.',
            'type.required' => 'El campo Tipo es obligatorio.',
        ]);

        $update = $companyCost->update($request->all());

        if (!$update) {
            return redirect()->route('company-cost.index')->with([
                'message' => '¡Error al actualizar Tarifa por Empresa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('company-cost.index')->with([
                'message' => 'Tarifa por Empresa actualizada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyCost $companyCost)
    {
        $delete = $companyCost->delete();

        if (!$delete) {
            return redirect()->route('company-cost.index')->with([
                'message' => '¡Error al eliminar Tarifa por Empresa!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('company-cost.index')->with([
                'message' => 'Tarifa por Empresa eliminada correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

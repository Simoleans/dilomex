<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Transporte\TransportLine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransportLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Catalogo/Transporte/TransportLine/Index', [
            'data' => TransportLine::orderBy('id', 'desc')->get(),
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

        //dd($request->all());

        $request->validate(
            [
                'company_name' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'email' => 'required|unique:transport_lines',
                'phone' => 'required',
            ],
        );

        $store = TransportLine::create($request->all());

        if (!$store) {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡Error al crear la linea de transporte!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡La linea de transporte se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportLine $transportLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransportLine $transportLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportLine $transportLine)
    {
        $request->validate(
            [
                'company_name' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'email' => [
                    'required',
                    Rule::unique('transport_lines')->ignore($transportLine->id),
                ],
                'phone' => 'required',
            ],
        );

        $update = $transportLine->update($request->all());

        if (!$update) {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡Error al actualizar la linea de transporte!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡La linea de transporte se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportLine $transportLine)
    {
        $delete = $transportLine->delete();

        if (!$delete) {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡Error al eliminar la linea de transporte!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('transport-lines.index')->with([
                'message' => '¡La linea de transporte se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

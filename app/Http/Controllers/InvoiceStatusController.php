<?php

namespace App\Http\Controllers;

use App\Models\InvoiceStatus;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Conceptos/InvoiceStatus/Index', [
            'data' => InvoiceStatus::orderBy('id','DESC')->get()
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
                'name' => 'required'
            ]);

            $store = InvoiceStatus::create(request()->all());

            if (!$store) {
                return redirect()->route('invoice-status.index')->with([
                    'message' => '¡Error al crear el estado de la factura!',
                    'type' => 'error'
                ]);
            } else {
                return redirect()->route('invoice-status.index')->with([
                    'message' => 'Estatus de la factura creado correctamente!',
                    'type' => 'success'
                ]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceStatus $invoiceStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceStatus $invoiceStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceStatus $invoiceStatus)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);

        $update = $invoiceStatus->update(request()->all());

        if (!$update) {
            return redirect()->route('invoice-status.index')->with([
                'message' => '¡Error al actualizar el estado de la factura!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('invoice-status.index')->with([
                'message' => 'Estatus de la factura actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceStatus $invoiceStatus)
    {
        $delete = $invoiceStatus->delete();

        if (!$delete) {
            return redirect()->route('invoice-status.index')->with([
                'message' => '¡Error al eliminar el estado de la factura!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('invoice-status.index')->with([
                'message' => 'Estatus de la factura eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

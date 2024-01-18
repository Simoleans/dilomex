<?php

namespace App\Http\Controllers;

use App\Models\InvoiceType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Conceptos/InvoiceType/Index', [
            'data' => InvoiceType::orderBy('id', 'desc')->get()
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

            request()->validate([
                'name' => ['required', 'max:255']
            ]);

            $store = InvoiceType::create(request()->all());

            if (!$store) {
                return redirect()->route('invoice-type.index')->with([
                    'message' => '¡Error al crear la empresa!',
                    'type' => 'error'
                ]);
            } else {
                return redirect()->route('invoice-type.index')->with([
                    'message' => 'Tipo de cliente creado correctamente!',
                    'type' => 'success'
                ]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceType $invoiceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceType $invoiceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceType $invoiceType)
    {
        request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $update = $invoiceType->update(request()->all());

        if (!$update) {
            return redirect()->route('invoice-type.index')->with([
                'message' => '¡Error al actualizar el tipo de factura!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('invoice-type.index')->with([
                'message' => 'Tipo de factura actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceType $invoiceType)
    {
        InvoiceType::destroy($invoiceType->id);

        return redirect()->route('invoice-type.index')->with([
            'message' => 'Tipo de factura eliminado correctamente!',
            'type' => 'success'
        ]);
    }
}

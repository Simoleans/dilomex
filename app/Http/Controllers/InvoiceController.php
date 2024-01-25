<?php

namespace App\Http\Controllers;

use App\Models\{Company, Invoice, Customer, InvoiceStatus, InvoiceType};
use App\Models\Catalogos\Tarifas\Family;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\{InvoiceStoreRequest, InvoiceUpdateRequest};

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Invoices/Index',[
            'data' => Invoice::with('invoiceType','customer','company','family','invoiceStatus')->orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Invoices/Create',[
            'companies' => Company::orderBy('id','desc')->get(),
            //status invoice
            'invoiceStatus' => InvoiceStatus::orderBy('id','desc')->get(),
            'invoiceTypes' => InvoiceType::orderBy('id','desc')->get(),
            'families' => Family::orderBy('id','desc')->get(),
            //'customers' => Customer::orderBy('id','desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request)
    {
        //dd($request->all());

        $store = Invoice::create($request->all());

       if (!$store) {
            return redirect()->route('invoices.index')->with([
                'message' => '¡Error al crear la factura!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('invoices.index')->with([
                'message' => 'Factura creada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }


}

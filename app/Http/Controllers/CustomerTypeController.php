<?php

namespace App\Http\Controllers;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Conceptos/CustomerType/Index', [
            'data' => CustomerType::orderBy('id', 'desc')->get()
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

        $store = CustomerType::create(request()->all());

       if (!$store) {
           return redirect()->route('customer-type.index')->with([
               'message' => '¡Error al crear la empresa!',
               'type' => 'error'
           ]);
         }else{
            return redirect()->route('customer-type.index')->with([
                'message' => 'Tipo de cliente creado correctamente!',
                'type' => 'success'
            ]);
         }


    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerType $customerType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerType $customerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerType $customerType)
    {
        request()->validate([
            'name' => ['required', 'max:255']
        ]);

        $update = $customerType->update(request()->all());

        if (!$update) {
            return redirect()->route('customer-type.index')->with([
                'message' => '¡Error al actualizar el tipo de cliente!',
                'type' => 'error'
            ]);
        }else{
            return redirect()->route('customer-type.index')->with([
                'message' => 'Tipo de cliente actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerType $customerType)
    {
        $delete = $customerType->delete();

        if (!$delete) {
            return redirect()->route('customer-type.index')->with([
                'message' => '¡Error al eliminar el tipo de cliente!',
                'type' => 'error'
            ]);
        }else{
            return redirect()->route('customer-type.index')->with([
                'message' => 'Tipo de cliente eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

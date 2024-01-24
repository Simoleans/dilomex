<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Administracion/Customers/Index', [
            'data' => Customer::with(['company', 'customerType', 'location'])->orderBy('id','desc')->get(),
            'companies' => \App\Models\Company::all(),
            'customerTypes' => \App\Models\CustomerType::all(),
            'locations' => \App\Models\Location::all(),
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
                'code' => 'required|unique:customers',
                'company_id' => 'required',
                'name' => 'required',
                'customer_type_id' => 'required',
                'location_id' => 'required',
            ],
            [
                'code.required' => 'El código es requerido',
                'code.unique' => 'El código ya existe',
                'company_id.required' => 'La empresa es requerida',
                'name.required' => 'El nombre es requerido',
                'customer_type_id.required' => 'El tipo de cliente es requerido',
                'location_id.required' => 'La ubicación es requerida',
            ]);

            $store = Customer::create($request->all());

            if($store){
                return redirect()->route('customers.index')->with([
                    'message' => '¡Error al crear la empresa!',
                    'type' => 'error'
                ]);
            }else{
                return redirect()->route('customers.index')->with([
                    'message' => 'Cliente creado correctamente!',
                    'type' => 'success'
                ]);
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'code' => 'required|unique:customers,code,'.$customer->id,
            'company_id' => 'required',
            'name' => 'required',
            'customer_type_id' => 'required',
            'location_id' => 'required',
        ],
        [
            'code.required' => 'El código es requerido',
            'code.unique' => 'El código ya existe',
            'company_id.required' => 'La empresa es requerida',
            'name.required' => 'El nombre es requerido',
            'customer_type_id.required' => 'El tipo de cliente es requerido',
            'location_id.required' => 'La ubicación es requerida',
        ]);

        $update = $customer->update($request->all());

        if($update){
            return redirect()->route('customers.index')->with([
                'message' => '¡Error al actualizar el cliente!',
                'type' => 'error'
            ]);
        }else{
            return redirect()->route('customers.index')->with([
                'message' => 'Cliente actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

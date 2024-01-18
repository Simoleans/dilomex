<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Company\CompanyStoreRequest;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Companies/Index', [
            'data' => Company::orderBy('id','DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {

       $store = Company::create($request->validated());

       if (!$store) {
           return redirect()->route('companies.index')->with([
               'message' => '¡Error al crear la empresa!',
               'type' => 'error'
           ]);
         }else{
            return redirect()->route('companies.index')->with([
                'message' => '¡Empresa creada correctamente!',
                'type' => 'success'
            ]);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $company->update($request->all());

        return redirect()->route('companies.index')->with([
            'message' => '¡Empresa actualizada correctamente!',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with([
            'message' => '¡Empresa eliminada correctamente!',
            'type' => 'success'
        ]);
    }
}

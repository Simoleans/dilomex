<?php

namespace App\Http\Controllers;

use App\Models\RejectionCode;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RejectionCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Catalogo/Conceptos/RejectionsCode/Index', [
            'data' => RejectionCode::with('company')->orderBy('id', 'desc')->get(),
            'companies' => \App\Models\Company::orderBy('name', 'desc')->get(),
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
            'code' => 'required',
            'description' => 'required',
        ]);

        RejectionCode::create($request->all());

        return redirect()->route('rejection-codes.index')->with([
            'message' => 'Codigo de rechazo creado correctamente.',
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RejectionCode $rejectionCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RejectionCode $rejectionCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RejectionCode $rejectionCode)
    {

        $request->validate([
            'company_id' => 'required',
            'code' => 'required',
            'description' => 'required',
        ]);

        $rejectionCode->update($request->all());

        return redirect()->route('rejection-codes.index')->with([
            'message' => 'Codigo de Rechazo actualizado correctamente.',
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RejectionCode $rejectionCode)
    {
        $rejectionCode->delete();

        return redirect()->route('rejection-codes.index')->with([
            'message' => 'Codigo de Rechazo eliminado correctamente.',
            'type' => 'success',
        ]);
    }
}

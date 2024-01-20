<?php

namespace App\Http\Controllers;

use App\Models\Catalogos\Transporte\TransportContact;
use Illuminate\Http\Request;

class TransportContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function page($type)
    {
        return inertia('Catalogo/Transporte/TransportContact/Index', [
            'data' => TransportContact::orderBy('id', 'desc')->get(),
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
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'type' => 'required',
            ],
            [
                'type.required' => 'El tipo de contacto es requerido'
            ]
        );

        $store = TransportContact::create($request->all());

        if (!$store) {
            return redirect()->route('transport-contacts.page',$store->type)->with([
                'message' => '¡Error al crear el contacto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('transport-contacts.page',$store->type)->with([
                'message' => '¡El contacto se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportContact $transportContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransportContact $transportContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportContact $transportContact)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'type' => 'required',
            ]
        );

        $update = $transportContact->update($request->all());

        if (!$update) {
            return redirect()->route('transport-contacts.page',$transportContact->type)->with([
                'message' => '¡Error al actualizar el contacto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('transport-contacts.page',$transportContact->type)->with([
                'message' => '¡El contacto se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportContact $transportContact)
    {
        $destroy = $transportContact->delete();

        if (!$destroy) {
            return redirect()->back()->with([
                'message' => '¡Error al eliminar el contacto!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => '¡El contacto se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}

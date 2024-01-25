<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_type_id' => 'required|integer|exists:invoice_types,id',
            'customer_id'     => 'required|integer|exists:customers,id',
            'company_id'      => 'required|integer|exists:companies,id',
            'family_id'       => 'required|integer|exists:families,id',
            'invoice_status_id' => 'required|integer|exists:invoice_statuses,id',
            'code_invoice'   => 'required|unique:invoices,code_invoice',
            'date_date'      => 'required|date',
            'date_portage'    => 'required|date',
            'date_concentrated' => 'required|date',
            'date_invoice'   => 'required|date',

            // Optional fields (not required)
            /* 'territory'     => 'nullable|string',
            'box_invoice'   => 'nullable|integer',
            'concentrated'   => 'nullable|integer',
            'weight'        => 'nullable|numeric',
            'order'         => 'nullable|integer',
            'price'         => 'nullable|numeric',
            'box_missing'   => 'nullable|integer',
            'part_missing'   => 'nullable|integer',
            'observations_missing' => 'nullable|string',
            'part_invoice'   => 'nullable|integer',
            'volume'        => 'nullable|numeric',
            'currency'      => 'nullable|string',
            'observations_invoice' => 'nullable|string',
            'barcode'       => 'nullable|string', */
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'invoice_type_id.required' => 'El tipo de factura es requerido.',
            'invoice_type_id.integer' => 'El tipo de factura debe ser un número entero.',
            'invoice_type_id.exists' => 'El tipo de factura no existe en la base de datos.',

            'customer_id.required' => 'El cliente es requerido.',
            'customer_id.integer' => 'El cliente debe ser un número entero.',
            'customer_id.exists' => 'El cliente no existe en la base de datos.',

            'company_id.required' => 'La empresa es requerida.',
            'company_id.integer' => 'La empresa debe ser un número entero.',
            'company_id.exists' => 'La empresa no existe en la base de datos.',

            'family_id.required' => 'La familia es requerida.',
            'family_id.integer' => 'La familia debe ser un número entero.',
            'family_id.exists' => 'La familia no existe en la base de datos.',

            'invoice_status_id.required' => 'El estado de la factura es requerido.',
            'invoice_status_id.integer' => 'El estado de la factura debe ser un número entero.',
            'invoice_status_id.exists' => 'El estado de la factura no existe en la base de datos.',

            'code_invoice.required' => 'El código de la factura es requerido.',
            'code_invoice.unique' => 'El código de la factura debe ser único.',

            'date_date.required' => 'La fecha de la factura es requerida.',
            'date_date.date' => 'La fecha de la factura debe ser una fecha válida.',

            'date_portage.required' => 'La fecha de porteo es requerida.',
            'date_portage.date' => 'La fecha de porteo debe ser una fecha válida.',

            'date_concentrated.required' => 'La fecha de concentrado es requerida.',
            'date_concentrated.date' => 'La fecha de concentrado debe ser una fecha válida.',

            'date_invoice.required' => 'La fecha de la factura es requerida.',
            'date_invoice.date' => 'La fecha de la factura debe ser una fecha válida.',

        ];
    }
}

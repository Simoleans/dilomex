<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'name' => 'required',
            'rfc' => 'required|unique:companies,rfc', // El campo rfc es único en la tabla companies
            'street' => 'required',
            'number' => 'required',
            'interior' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required'
        ];
    }
}

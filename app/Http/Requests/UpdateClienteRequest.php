<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\RutValido;

class UpdateClienteRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'rut_empresa' => ['required', 'string', new RutValido,
            Rule::unique('clientes', 'rut_empresa')->ignore($this->route('cliente'))],
        'rubro' => ['required', 'string', 'max:255'],
        'razon_social' => ['required', 'string', 'max:255'],
        'telefono' => ['required', 'string', 'max:20'],
        'direccion' => ['required', 'string', 'max:255'],
        'nombre_contacto' => ['required', 'string', 'max:255'],
        'email_contacto' => ['required', 'email', 'max:255'],
    ];
}
}

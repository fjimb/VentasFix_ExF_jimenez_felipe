<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductoRequest extends FormRequest
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
    $producto = $this->route('producto');

    return [
        'sku' => ['required', 'string', 'max:50',
            Rule::unique('productos', 'sku')->ignore($producto)],
        'nombre' => ['required', 'string', 'max:255'],
        'descripcion_corta' => ['required', 'string', 'max:250'],
        'descripcion_larga' => ['required', 'string'],
        'imagen' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        'precio_neto' => ['required', 'integer', 'min:1'],
        'stock_actual' => ['required', 'integer', 'min:0'],
        'stock_minimo' => ['required', 'integer', 'min:0'],
        'stock_bajo' => ['required', 'integer', 'min:0', 'gte:stock_minimo'],
        'stock_alto' => ['required', 'integer', 'min:0', 'gte:stock_bajo'],
    ];
}
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'sku' => ['required', 'string', 'max:50', 'unique:productos,sku'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion_corta' => ['required', 'string', 'max:250'],
            'descripcion_larga' => ['required', 'string'],
            'imagen' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'precio_neto' => ['required', 'integer', 'min:1'],
            'stock_actual' => ['required', 'integer', 'min:0'],
            'stock_minimo' => ['required', 'integer', 'min:0'],
            'stock_bajo' => ['required', 'integer', 'min:0', 'gte:stock_minimo'],
            'stock_alto' => ['required', 'integer', 'min:0', 'gte:stock_bajo'],
        ];
    }
}

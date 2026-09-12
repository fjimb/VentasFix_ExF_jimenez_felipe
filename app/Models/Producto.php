<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Override;

#[Fillable(['sku', 'nombre', 'descripcion_corta', 'descripcion_larga', 
     'imagen', 'precio_neto', 'stock_actual', 'stock_alto', 'stock_bajo',
     'stock_minimo'])]
class Producto extends Model
{
    #[Override]
    protected function casts(): array
    {
        return [
            'precio_neto' => 'integer',
            'precio_de_venta' => 'integer',
            'stock_actual' => 'integer',
            'stock_alto' => 'integer',
            'stock_bajo' => 'integer',
            'stock_minimo' => 'integer'
        ];
    }

    protected function precioNeto(): Attribute
    {
        return Attribute::make(
            set: fn (int $value) => [
                'precio_neto' => $value,
                'precio_de_venta' => (int) round($value * 1.19),
            ],
        );
    }
}

<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'VentasFix API',
    description: 'API REST del backoffice de VentasFix para la gestión de usuarios, productos y clientes. '.
        'Pensada para el consumo desde aplicaciones de terceros (por ejemplo, el sistema de gestión Softland). '.
        'Todos los endpoints protegidos requieren un token Bearer obtenido en /api/login.',
    contact: new OA\Contact(name: 'Felipe Jiménez', email: 'felipeandresjb99@gmail.com')
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Servidor local de desarrollo'
)]
#[OA\SecurityScheme(
    securityScheme: 'sanctum',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum',
    description: 'Introduce el token entregado por /api/login como: Bearer {token}'
)]
#[OA\Tag(name: 'Autenticación', description: 'Inicio y cierre de sesión de la API')]
#[OA\Tag(name: 'Usuarios', description: 'CRUD de usuarios del sistema (@ventasfix.cl)')]
#[OA\Tag(name: 'Productos', description: 'CRUD de productos con cálculo automático de IVA')]
#[OA\Tag(name: 'Clientes', description: 'CRUD de clientes empresa')]
#[OA\Schema(
    schema: 'User',
    title: 'Usuario',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'rut', type: 'string', example: '12.345.678-5'),
        new OA\Property(property: 'nombre', type: 'string', example: 'Felipe'),
        new OA\Property(property: 'apellido', type: 'string', example: 'Jiménez'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'felipe@ventasfix.cl'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'Producto',
    title: 'Producto',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'sku', type: 'string', example: 'SKU-001'),
        new OA\Property(property: 'nombre', type: 'string', example: 'Teclado mecánico'),
        new OA\Property(property: 'descripcion_corta', type: 'string', example: 'Teclado RGB'),
        new OA\Property(property: 'descripcion_larga', type: 'string', example: 'Teclado mecánico retroiluminado con switches azules.'),
        new OA\Property(property: 'imagen', type: 'string', example: 'productos/abc123.jpg'),
        new OA\Property(property: 'precio_neto', type: 'integer', example: 10000),
        new OA\Property(property: 'precio_de_venta', type: 'integer', example: 11900, description: 'Precio con IVA (19%), calculado automáticamente'),
        new OA\Property(property: 'stock_actual', type: 'integer', example: 50),
        new OA\Property(property: 'stock_minimo', type: 'integer', example: 5),
        new OA\Property(property: 'stock_bajo', type: 'integer', example: 10),
        new OA\Property(property: 'stock_alto', type: 'integer', example: 100),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'Cliente',
    title: 'Cliente',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'rut_empresa', type: 'string', example: '76.123.456-7'),
        new OA\Property(property: 'rubro', type: 'string', example: 'Retail'),
        new OA\Property(property: 'razon_social', type: 'string', example: 'Comercial Los Andes SpA'),
        new OA\Property(property: 'telefono', type: 'string', example: '+56 9 1234 5678'),
        new OA\Property(property: 'direccion', type: 'string', example: 'Av. Siempre Viva 123'),
        new OA\Property(property: 'nombre_contacto', type: 'string', example: 'María Pérez'),
        new OA\Property(property: 'email_contacto', type: 'string', format: 'email', example: 'maria@losandes.cl'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'ValidationError',
    title: 'Error de validación',
    properties: [
        new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
        new OA\Property(property: 'errors', type: 'object', example: ['email' => ['El campo email es obligatorio.']]),
    ]
)]
abstract class Controller
{
    //
}

# VentasFix — Backoffice + API

Sistema desarrollado como examen final de la asignatura (Instituto Profesional San Sebastián).
Corresponde al caso **VentasFix**: un *backoffice* para modernizar el sistema de venta online de la
empresa, construido con **Laravel**.

La aplicación permite administrar la plataforma desde una interfaz gráfica (con login de acceso para los
trabajadores) y, además, expone una **API REST autenticada** para que aplicaciones de terceros —como el
sistema de gestión Softland— puedan consumir los datos.

## ¿Qué incluye?

- **Backoffice web** con autenticación (login/logout) y un dashboard con el conteo de usuarios, productos y clientes.
- **CRUD completo** (Crear, Leer, Actualizar, Eliminar) para:
  - **Usuarios** del sistema (email obligatorio del dominio `@ventasfix.cl`, contraseña cifrada).
  - **Productos** (con imagen y cálculo automático del precio de venta aplicando 19% de IVA).
  - **Clientes** empresa.
- **API REST** protegida con **Laravel Sanctum** (autenticación por token Bearer).
- **Documentación interactiva de la API con Swagger** (L5 Swagger / OpenAPI).

## 🔗 Enlaces rápidos (con el servidor levantado)

- **Aplicación web:** http://localhost:8000
- **Documentación Swagger (API):** **http://localhost:8000/api/documentation**

### 👤 Usuario de acceso por defecto

Al ejecutar las migraciones con seed (ver instalación) se crea este usuario administrador:

| Email                  | Contraseña   |
|------------------------|--------------|
| `felipe@ventasfix.cl`  | `password123`|

## Stack / Requisitos

- **PHP** >= 8.3 (probado con 8.5)
- **Composer** 2.x
- **Node.js** >= 18 y **npm** (para compilar los assets con Vite + Tailwind)
- Base de datos **SQLite** (por defecto; no requiere instalar un motor aparte)

Verifica que las herramientas estén disponibles:

```sh
php -v
composer -V
node -v
npm -v
```

## Instalación paso a paso

### 1. Clonar / descomprimir el proyecto y entrar a la carpeta

```sh
cd EXF_JIMENEZ_FELIPE
```

### 2. Instalar dependencias de PHP

```sh
composer install
```

### 3. Instalar dependencias de JavaScript

```sh
npm install
```

### 4. Configurar el archivo de entorno

```sh
cp .env.example .env
php artisan key:generate
```

### 5. Preparar la base de datos (SQLite)

El proyecto usa SQLite por defecto. Crea el archivo de base de datos (si no existe), ejecuta las migraciones
y siembra el usuario administrador por defecto:

```sh
touch database/database.sqlite
php artisan migrate --seed
```

> En Windows (PowerShell) puedes crear el archivo con: `New-Item database/database.sqlite`.

El comando `--seed` crea automáticamente el usuario de acceso **`felipe@ventasfix.cl`** con la contraseña
**`password123`**.

### 6. Crear el enlace de almacenamiento (imágenes de productos)

Las imágenes de los productos se guardan en `storage/app/public`. Para que sean accesibles públicamente:

```sh
php artisan storage:link
```

### 7. Generar la documentación de la API (Swagger)

Genera el archivo OpenAPI que alimenta a Swagger UI. Ejecútalo tras clonar el proyecto (y cada vez que
modifiques las anotaciones de los controladores):

```sh
php artisan l5-swagger:generate
```

La documentación quedará disponible en **http://localhost:8000/api/documentation** una vez levantado el servidor.

### 8. (Opcional) Crear usuarios adicionales

El usuario administrador ya quedó creado con el `--seed` del paso 5
(**`felipe@ventasfix.cl`** / **`password123`**). Si quieres crear más usuarios manualmente, recuerda que
el email debe pertenecer al dominio **@ventasfix.cl**. Puedes hacerlo con Tinker:

```sh
php artisan tinker
```

```php
\App\Models\User::create([
    'rut' => '11.111.111-1',
    'nombre' => 'Admin',
    'apellido' => 'VentasFix',
    'email' => 'admin@ventasfix.cl',
    'password' => 'clave1234',
]);
```

(La contraseña se cifra automáticamente al guardarse.)

### 9. Compilar los assets y levantar el servidor

En una terminal, compila el frontend:

```sh
npm run dev
```

En otra terminal, levanta el servidor de Laravel:

```sh
php artisan serve
```

La aplicación quedará disponible en **http://localhost:8000**.

> Alternativa: si solo quieres generar los assets una vez (sin recarga en caliente), usa `npm run build` en
> lugar de `npm run dev`.

## Uso

### Backoffice web

1. Abre **http://localhost:8000**.
2. Inicia sesión con el usuario por defecto: **`felipe@ventasfix.cl`** / **`password123`**.
3. Desde el dashboard puedes administrar **usuarios**, **productos** y **clientes**.

### API REST + Swagger

La documentación interactiva (Swagger UI) está disponible en:

**http://localhost:8000/api/documentation**

Todos los endpoints (excepto `login`) requieren autenticación por token. El flujo típico es:

1. Hacer `POST /api/login` con `email` y `password` → devuelve un `token`.
2. En Swagger UI, pulsar el botón **Authorize** e introducir el token como: `Bearer {token}`.
3. Ya puedes probar el resto de endpoints.

Endpoints disponibles:

| Recurso   | Endpoints                                                                 |
|-----------|--------------------------------------------------------------------------|
| Auth      | `POST /api/login`, `POST /api/logout`                                     |
| Usuarios  | `GET/POST /api/usuarios`, `GET/PUT/DELETE /api/usuarios/{id}`             |
| Productos | `GET/POST /api/productos`, `GET/PUT/DELETE /api/productos/{id}`           |
| Clientes  | `GET/POST /api/clientes`, `GET/PUT/DELETE /api/clientes/{id}`             |

> Si modificas las anotaciones de Swagger en los controladores, regenera la documentación con:
> ```sh
> php artisan l5-swagger:generate
> ```

## Comandos útiles

```sh
composer install          # Instalar dependencias PHP
composer update           # Actualizar dependencias PHP
npm install               # Instalar dependencias JS
npm run dev               # Compilar assets con recarga en caliente
npm run build             # Compilar assets para producción
php artisan migrate       # Ejecutar migraciones
php artisan migrate --seed      # Migrar y crear el usuario admin por defecto
php artisan db:seed             # Crear/asegurar el usuario admin por defecto
php artisan migrate:fresh --seed # Recrear la base de datos desde cero y sembrar
php artisan storage:link  # Enlazar el almacenamiento público
php artisan serve         # Levantar el servidor de desarrollo
php artisan l5-swagger:generate  # Regenerar la documentación de la API
php artisan test          # Ejecutar los tests
```

## Notas técnicas

- **Autenticación de la API:** Laravel Sanctum (tokens personales).
- **Cifrado de contraseñas:** las contraseñas se almacenan *hasheadas* automáticamente (cast `hashed` en el modelo `User`).
- **Validación de dominio:** los usuarios deben tener un email `@ventasfix.cl`.
- **IVA:** el `precio_de_venta` de los productos se calcula automáticamente aplicando un 19% sobre el `precio_neto`.
- **Validaciones:** los métodos de escritura (crear/actualizar) no permiten datos vacíos (todos los campos son obligatorios).

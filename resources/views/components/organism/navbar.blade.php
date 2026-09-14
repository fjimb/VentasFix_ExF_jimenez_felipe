<nav class="bg-white shadow">
    <div class="mx-auto flex max-w-7xl items-center justify-between p-4">
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="text-lg font-bold">VentasFix</a>

            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="{{ route('usuarios.index') }}" class="text-gray-700 hover:text-blue-600">Usuarios</a>
            <a href="{{ route('productos.index') }}" class="text-gray-700 hover:text-blue-600">Productos</a>
            <a href="{{ route('clientes.index') }}" class="text-gray-700 hover:text-blue-600">Clientes</a>
        </div>

        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">
                {{ auth()->user()->nombre }} {{ auth()->user()->apellido }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-red-600">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>
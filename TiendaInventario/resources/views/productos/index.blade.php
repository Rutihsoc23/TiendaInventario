@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Inventario de Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Registrar Nuevo Producto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('productos.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label for="filtro_nombre" class="form-label">Filtrar por Nombre:</label>
                    <input type="text" name="filtro_nombre" id="filtro_nombre" class="form-control" placeholder="Ej: Laptop, Mouse..." value="{{ request('filtro_nombre') }}">
                </div>
                <div class="col-md-3">
                    <label for="ordenar_por" class="form-label">Ordenar por:</label>
                    <select name="ordenar_por" id="ordenar_por" class="form-select">
                        <option value="nombre" @selected(request('ordenar_por') == 'nombre')>Nombre</option>
                        <option value="precio" @selected(request('ordenar_por') == 'precio')>Precio</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <select name="direccion" id="direccion" class="form-select">
                        <option value="asc" @selected(request('direccion') == 'asc')>Ascendente</option>
                        <option value="desc" @selected(request('direccion') == 'desc')>Descendente</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-outline-info w-100">Aplicar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Descuento (%)</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ Str::limit($producto->descripcion, 50) }}</td>
                        <td>S/ {{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->descuento }}%</td>
                        <td>{{ $producto->cantidad_stock }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <button class="btn btn-danger btn-sm"
                                    onclick="prepararEliminacion(this)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-url="{{ route('productos.destroy', $producto->id) }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class_("d-flex justify-content-center">
        {{ $productos->appends(request()->query())->links() }}
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function prepararEliminacion(button) {
            // Obtener la URL del atributo 'data-url' del botón
            const url = $(button).data('url');

            // Asignar esa URL al 'action' del formulario dentro del modal
            $('#deleteForm').attr('action', url);
        }
    </script>
@endpush

@extends('layouts.app')

@section('title', 'Registrar Producto')

@section('content')
    <h1 class="mb-4">Registrar Nuevo Producto</h1>

    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Ups! Hubo algunos problemas:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('productos.store') }}" method="POST">
                @csrf <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="{{ old('precio') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="descuento" class="form-label">Descuento (%)</label>
                        <input type="number" class="form-control" id="descuento" name="descuento" step="0.01" min="0" max="100" value="{{ old('descuento', 0) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
                        <input type="number" class="form-control" id="cantidad_stock" name="cantidad_stock" min="0" value="{{ old('cantidad_stock', 0) }}" required>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
@endsection

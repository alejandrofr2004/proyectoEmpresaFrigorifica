@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ isset($producto) ? 'Editar Producto' : 'Crear Producto' }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('showProducts') }}">Productos</a></li>
            <li class="breadcrumb-item active">{{ isset($producto) ? 'Editar' : 'Crear' }}</li>
        </ol>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-1"></i>
                {{ isset($producto) ? 'Formulario de edición' : 'Formulario de creación' }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($producto) ? route('updateProduct', $producto->id) : route('storeProduct') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($producto))
                        @method('PUT')
                    @endif

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" required>
                        </div>

                        {{-- Precio --}}
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" required>
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" required>
                        </div>

                        {{-- Imagen --}}
                        <div class="col-md-6 mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" name="imagen">
                            @if(isset($producto) && $producto->imagen_url)
                                <img src="{{ asset($producto->imagen_url) }}" alt="Imagen actual" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>

                        {{-- Categoría --}}
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-select" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($producto) ? 'Actualizar producto' : 'Crear producto' }}
                        </button>
                        <a href="{{ route('showProducts') }}" class="btn btn-secondary me-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

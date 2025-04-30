@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ isset($categoria) ? 'Editar Categoría' : 'Crear Categoría' }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('showCategories') }}">Categorías</a></li>
            <li class="breadcrumb-item active">{{ isset($categoria) ? 'Editar' : 'Crear' }}</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-tags me-1"></i> {{-- Icono de etiquetas para Categorías --}}
                {{ isset($categoria) ? 'Formulario de edición' : 'Formulario de creación' }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($categoria) ? route('updateCategory', $categoria->id) : route('storeCategory') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($categoria))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="padre_id" class="form-label">Categoría Padre (opcional)</label>
                            <select name="padre_id" id="padre_id" class="form-select">
                                <option value="">Sin padre</option>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ (old('padre_id', $categoria->padre_id ?? '') == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                            @if(isset($categoria) && $categoria->imagen)
                                <div class="mt-2">
                                    <img src="{{ asset($categoria->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($categoria) ? 'Actualizar categoría' : 'Crear categoría' }}
                        </button>
                        <a href="{{ route('showCategories') }}" class="btn btn-secondary ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

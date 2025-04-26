@extends('layouts.baseView')

@section('content')
    <div class="container mt-4">
        <h2>{{ isset($categoria) ? 'Editar Categoría' : 'Crear Categoría' }}</h2>

        <form method="POST" action="{{ isset($categoria) ? route('updateCategory', $categoria->id) : route('storeCategory') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($categoria))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre ?? '') }}" required>
            </div>

            <div class="mb-3">
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

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" class="form-control">
                @if(isset($categoria) && $categoria->imagen)
                    <div class="mt-2">
                        <img src="{{ asset($categoria->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($categoria) ? 'Actualizar' : 'Crear' }}
            </button>
            <a href="{{ route('showCategories') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

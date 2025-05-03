@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Listado de productos</li>
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
                Lista de productos
                @role('admin')
                <a href="{{ route('createProduct') }}" class="btn btn-success btn-sm float-end">
                    <i class="fas fa-plus-circle"></i> Añadir Producto
                </a>
                @endrole
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                        <th>Id categoría</th>
                        @role('admin')
                        <th>Acciones</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>€{{ number_format($producto->precio, 2) }}/kg</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                @if ($producto->imagen_url)
                                    <img src="{{ asset($producto->imagen_url) }}" alt="Imagen" style="width: 80px; height: auto;">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $producto->categoria_id }}</td>
                            @role('admin')
                            <td>
                                <a href="{{ route('editProduct', $producto->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('deleteProduct', $producto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            @endrole
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

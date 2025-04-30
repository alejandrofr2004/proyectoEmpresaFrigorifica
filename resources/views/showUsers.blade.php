@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuarios</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Listado de usuarios</li>
        </ol>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-users me-1"></i>
                Lista de usuarios
                <a href="{{ route('createUser') }}" class="btn btn-success btn-sm float-end">
                    <i class="fas fa-plus-circle"></i> Añadir Usuario
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->first_name }}</td>
                            <td>{{ $usuario->last_name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->phone ?? '—' }}</td>
                            <td>
                                <a href="{{ route('editUser', $usuario->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('deleteUser', $usuario->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

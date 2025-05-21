@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">{{ isset($usuario) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('showUsers') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">{{ isset($usuario) ? 'Editar' : 'Crear' }}</li>
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
                {{ isset($usuario) ? 'Formulario de edición' : 'Formulario de creación' }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($usuario) ? route('updateUser', $usuario->id) : route('storeUser') }}">
                    @csrf
                    @if(isset($usuario))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $usuario->first_name ?? '') }}" required>
                            @error('first_name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Apellido</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $usuario->last_name ?? '') }}" required>
                            @error('last_name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email ?? '') }}" required>
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $usuario->phone ?? '') }}">
                            @error('phone')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $roleName)
                                    <option value="{{ $roleName }}" {{ $usuario->roles->pluck('name')->contains($roleName) ? 'selected' : '' }}>
                                        {{ ucfirst($roleName) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña {{ isset($usuario) ? '(dejar vacío para no cambiar)' : '' }}</label>
                            <input type="password" name="password" id="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
                            @error('password')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($usuario) ? 'Actualizar usuario' : 'Crear usuario' }}
                        </button>
                        <a href="{{ route('showUsers') }}" class="btn btn-secondary ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

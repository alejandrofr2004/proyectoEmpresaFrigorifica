@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Panel de Administración</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        {{-- Mensajes de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="row">
            {{-- Total Productos --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        Total Productos
                        <div class="fs-2">{{ \App\Models\Product::count() }}</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="text-white small stretched-link" href="{{ route('showProducts') }}">Ver todos</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            {{-- Total Categorías --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        Total Categorías
                        <div class="fs-2">{{ \App\Models\Category::count() }}</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="text-white small stretched-link" href="{{ route('showCategories') }}">Gestionar categorías</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            {{-- Crear Producto --}}
            @role('admin')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        Crear Producto
                        <div class="fs-2"><i class="fas fa-plus-circle"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="text-white small stretched-link" href="{{ route('createProduct') }}">Nuevo producto</a>
                        <div class="text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @endrole


            {{-- Placeholder para estadísticas futuras --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        Últimos cambios
                        <div class="fs-6">Próximamente...</div>
                    </div>
                    <div class="card-footer">
                        <span class="text-white small">En desarrollo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

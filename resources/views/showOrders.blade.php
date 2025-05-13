@extends('layouts.baseView')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pedidos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Listado de pedidos</li>
        </ol>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-shopping-cart me-1"></i>
                Lista de pedidos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        @role('admin')
                        <th>Acciones</th>
                        @endrole
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente_id }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                            <td>€{{ number_format($pedido->total, 2) }}</td>
                            @role('admin')
                            <td>
                                <form action="{{ route('deleteOrder', $pedido->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este pedido?');">
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

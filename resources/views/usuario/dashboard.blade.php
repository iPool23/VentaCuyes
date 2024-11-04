@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin|empleado')
<div class="d-flex flex-column min-vh-100 mx-4">
    <div class="content-header w-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="m-0 text-center">Panel de Control</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content flex-grow-1">
        <div class="container-fluid">
            <div class="row">
                <!-- Usuarios Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ \App\Models\Usuario::count() }}</h3>
                            <p>Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('usuario.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Clientes Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ \App\Models\Cliente::count() }}</h3>
                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="{{ route('cliente.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Empleados Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ \App\Models\Empleado::count() }}</h3>
                            <p>Empleados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="{{ route('empleado.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Proveedores Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\Models\Proveedor::count() }}</h3>
                            <p>Proveedores</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="{{ route('proveedor.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Ventas Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ \App\Models\Venta::count() }}</h3>
                            <p>Ventas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{ route('venta.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Platos Card -->
                <div class="col-lg-2 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ \App\Models\PlatoCuy::count() }}</h3>
                            <p>Platos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <a href="{{ route('plato-cuy.index') }}" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Data Tables -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Últimas Ventas
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Plato</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $ventas = \App\Models\Venta::with(['cliente', 'detalles.plato'])
                                    ->orderBy('created_at', 'desc')
                                    ->take(5)
                                    ->get();
                                    @endphp

                                    @if($ventas->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle"></i> Aún no hay ventas registradas
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($ventas as $venta)
                                    @foreach($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $venta->cliente->usuario->nombres }} {{ $venta->cliente->usuario->apellidos }}</td>
                                        <td>{{ $detalle->plato->nombre_plato }}</td>
                                        <td>S/. {{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-utensils mr-1"></i>
                                Platos Más Vendidos
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Plato</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $platosVendidos = \App\Models\DetalleVenta::selectRaw('plato_id,
                                    SUM(cantidad) as total_cantidad,
                                    SUM(subtotal) as total_ventas')
                                    ->with('plato')
                                    ->groupBy('plato_id')
                                    ->orderBy('total_cantidad', 'desc')
                                    ->take(5)
                                    ->get();
                                    @endphp

                                    @if($platosVendidos->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle"></i> Aún no hay ventas registradas
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach($platosVendidos as $detalle)
                                    <tr>
                                        <td>{{ $detalle->plato->nombre_plato }}</td>
                                        <td>{{ $detalle->total_cantidad }}</td>
                                        <td>S/. {{ number_format($detalle->total_ventas, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@else
<div class="alert alert-danger">
    No tienes permiso para acceder a esta sección.
</div>
@endhasanyrole

@endsection

@push('styles')
<style>
    .content-wrapper {
        margin-left: 0 !important;
        margin-right: 0 !important;
        padding: 0 !important;
        background: transparent !important;
    }

    .main-sidebar {
        position: fixed;
    }

    .content {
        padding: 20px;
        width: 100%;
    }

    .main-footer {
        margin-top: auto !important;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .small-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 0.25rem;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        margin-bottom: 20px;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
</style>
@endpush
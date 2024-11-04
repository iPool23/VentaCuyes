@extends('plantilla.app')

@section('contenido')
<div class="container py-4">
    <div class="row">
        <!-- Información del Usuario -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="{{ asset('perfiles/user-avatar.png') }}"
                        class="rounded-circle mb-3"
                        style="width: 120px; height: 120px; object-fit: cover;">
                    <h4>{{ $usuario->nombres }} {{ $usuario->apellidos }}</h4>
                    <p class="text-muted">{{ $usuario->email }}</p>
                    <hr>

                    @if(isset($cliente))
                    <div class="text-start">
                        <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
                        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                        <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Historial de Compras -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-color-top">
                    <h5 class="card-title mb-0">Historial de Compras</h5>
                </div>
                <div class="card-body">
                    @if($ventas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Platos</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ventas as $venta)
                                    <tr>
                                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @foreach($venta->detalles as $detalle)
                                                {{ $detalle->plato->nombre_plato }} ({{ $detalle->cantidad }})<br>
                                            @endforeach
                                        </td>
                                        <td>S/. {{ number_format($venta->total, 2) }}</td>
                                        <td>
                                            @if($venta->estado == 1)
                                                <span class="badge bg-success">Servido</span>
                                            @else
                                                <span class="badge bg-danger">Cancelada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            No hay compras registradas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
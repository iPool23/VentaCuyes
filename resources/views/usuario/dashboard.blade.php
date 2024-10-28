@extends('plantilla.app')

@section('contenido')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Bienvenido al Dashboard de Ventas</h1>
                        <div class="row">
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                                        <h5 class="card-title">Usuarios</h5>
                                        <p class="card-text">Gestiona los usuarios del sistema</p>
                                        <a href="{{ route('usuario.index') }}" class="btn btn-primary">Ir a Usuarios</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-box fa-3x mb-3 text-success"></i>
                                        <h5 class="card-title">Catálogo</h5>
                                        <p class="card-text">Administra el catálogo de cuyes</p>
                                        <a href="#" class="btn btn-success">Ir a tipos de cuyes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-box fa-3x mb-3 text-success"></i>
                                        <h5 class="card-title">Ventas</h5>
                                        <p class="card-text">Administra las ventas realizadas</p>
                                        <a href="{{ route('venta.index') }}" class="btn btn-success">Ventas</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Highlight the active menu item
        $('#liDashboard').addClass("active");
    });
</script>
@endpush
@extends('plantilla.app')

@section('contenido')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Ventas
                                <button class="btn btn-primary" id="btnNuevaVenta"><i class="fas fa-plus"></i> Nueva
                                    Venta</button>
                                <a href="" class="btn btn-success"><i class="fas fa-file-csv"></i> Exportar CSV</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if (Session::has('mensaje'))
                                <div class="alert alert-info alert-dismissible fade show">
                                    <span class="alert-icon"><i class="fa fa-info-circle"></i></span>
                                    <span class="alert-text">{{ Session::get('mensaje') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($ventas === null || count($ventas) == 0)
                                <div class="alert alert-secondary" role="alert">
                                    No hay ventas para mostrar.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>ID Venta</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ventas as $venta)
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm btnEditarVenta"
                                                            data-id="{{ $venta->id }}"><i
                                                                class="fas fa-edit"></i></button>
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#modal-eliminar-{{ $venta->id }}"
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                    <td>{{ $venta->id }}</td>
                                                    <td>{{ $venta->cliente->nombre }}</td>
                                                    <td>{{ $venta->fecha }}</td>
                                                    <td>{{ number_format($venta->total, 2) }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm btnDetalles"
                                                            data-id="{{ $venta->id }}"><i class="fas fa-eye"></i> Ver
                                                            Detalles</button>
                                                    </td>
                                                </tr>
                                                @include('venta.delete') <!-- Modal para eliminar venta -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $ventas->links() }} <!-- Agrega paginación si es necesario -->
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETALLES -->
    <div class="modal fade" id="modal-detalles" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg"></div>
    </div>
    <!-- FIN MODAL DETALLES -->

    <!-- MODAL UPDATE -->
    <div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg"></div>
    </div>
    <!-- FIN MODAL UPDATE -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#liVentas').addClass("menu-open");
            $('#liVenta').addClass("active");
            $('#aVentas').addClass("active");

            // Cargar formulario (para crear o editar)
            function loadForm(url) {
                $.ajax({
                    method: 'GET',
                    url: url,
                    success: function(res) {
                        $('#modal-action').find('.modal-dialog').html(res);
                        $('#modal-action').modal("show");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        alert("Error al cargar el formulario. Por favor, intente de nuevo.");
                    }
                });
            }

            // Cargar detalles de la venta
            function loadDetalles(url) {
                $.ajax({
                    method: 'GET',
                    url: url,
                    success: function(res) {
                        $('#modal-detalles').find('.modal-dialog').html(res);
                        $('#modal-detalles').modal("show");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        alert("Error al cargar los detalles de la venta. Por favor, intente de nuevo.");
                    }
                });
            }

            // Botón Nueva Venta
            $('#btnNuevaVenta').on('click', function(e) {
                e.preventDefault();
                loadForm("{{ route('venta.create') }}");
            });

            // Botón Editar Venta
            $(document).on('click', '.btnEditarVenta', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                loadForm("{{ url('venta') }}/" + id + "/edit");
            });

            // Botón Ver Detalles
            $(document).on('click', '.btnDetalles', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                loadDetalles("{{ url('venta') }}/" + id + "/detalles");
            });

            // Manejar el envío del formulario
            $(document).on('submit', '#ventaForm', function(e) {
                e.preventDefault();
                var form = $(this);
                var method = form.find('input[name="_method"]').val() || 'POST';

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        $('#modal-action').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Si hay errores de validación
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            // Limpiar errores anteriores
                            $('.text-danger').text('');
                            // Mostrar nuevos errores
                            Object.keys(errors).forEach(function(key) {
                                $('#' + key).siblings('.text-danger').text(errors[key][
                                    0]);
                            });
                        } else {
                            alert("Error al guardar los cambios. Por favor, intente de nuevo.");
                        }
                    }
                });
            });
        });
    </script>
@endpush

@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">
                            Ventas
                            <a class="btn btn-primary" href="{{ route('venta.create') }}"><i class="fas fa-plus"></i> Nueva
                                Venta</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('venta.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input name="texto" type="text" class="form-control" value="{{ $texto }}"
                                    placeholder="Buscar ventas...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if (session('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <span class="alert-icon"><i class="fa fa-info-circle"></i></span>
                            <span class="alert-text">{{ session('mensaje') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if ($ventas->isEmpty())
                        <div class="alert alert-secondary" role="alert">
                            No hay ventas para mostrar.
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Cliente | DNI</th>
                                        <th>Cliente | Nombres</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                    <tr>
                                        <td>
                                            <button class="btn btn-warning btn-sm btnEditar"
                                                data-id="{{ $venta->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-eliminar-{{ $venta->id }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{ $venta->cliente->dni }}</td>
                                        <td>{{ $venta->cliente->Usuario->nombres }}
                                            {{ $venta->cliente->Usuario->apellidos }}
                                        </td>
                                        <td>{{ $venta->fecha }}</td>
                                        <td>{{ number_format($venta->total, 2) }}</td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-detalles-{{ $venta->id }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('venta.delete')
                                    @include('venta.detalles')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $ventas->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar -->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl"></div>
</div>

{{-- MODAL PARA CUANDO NO HAY PLATOS --}}
<div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mensajeModalLabel">Información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="mensajeModalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</section>

@else
<div class="alert alert-danger">
    No tienes permiso para acceder a esta sección.
</div>
@endhasanyrole


@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#liVenta').addClass("menu-open");
        $('#liVenta').addClass("active");
        $('#aVenta').addClass("active");

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
            inicializarCalculoTotal();
        }

        // Función para calcular el total
        function inicializarCalculoTotal() {
            function calcularTotal() {
                let total = 0;
                const cantidadInputs = document.querySelectorAll('.cantidad-input');

                cantidadInputs.forEach(input => {
                    const cantidad = parseInt(input.value) || 0;
                    const precio = parseFloat(input.dataset.precio) || 0;
                    total += cantidad * precio;
                });

                const totalInput = document.getElementById('total');
                if (totalInput) {
                    totalInput.value = total.toFixed(2);
                }
            }

            // Agregar event listeners usando delegación de eventos
            $(document).on('change input', '.cantidad-input', function() {
                calcularTotal();
            });

            // Calcular el total inicial
            calcularTotal();
        }

        // Botón Nuevo
        $('#btnNuevo').on('click', function(e) {
            e.preventDefault();
            loadForm("{{ route('venta.create') }}");
        });

        // Event listeners para los botones y el formulario
        $(document).ready(function() {
            $(document).on('click', '.btnEditar', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                loadForm("/venta/" + id + "/edit");
            });

            $(document).on('submit', '#VentasForm', function(e) {
                e.preventDefault();
                const form = this;
                const $form = $(this);
                const cantidadInputs = form.querySelectorAll('.cantidad-input');

                // Eliminar todos los inputs hidden previos de platos
                form.querySelectorAll('input[name^="platos["]').forEach(input => input
                    .remove());

                let hayPlatosSeleccionados = false;

                // Crear inputs hidden para cada plato con cantidad > 0
                cantidadInputs.forEach(input => {
                    const cantidad = parseInt(input.value) || 0;
                    const platoId = input.name.match(/\d+/)[0];

                    if (cantidad > 0) {
                        // Crear input para el ID del plato
                        const idInput = document.createElement('input');
                        idInput.type = 'hidden';
                        idInput.name = `platos[${platoId}][id]`;
                        idInput.value = platoId;
                        form.appendChild(idInput);

                        // Crear input para la cantidad
                        const cantidadInput = document.createElement('input');
                        cantidadInput.type = 'hidden';
                        cantidadInput.name = `platos[${platoId}][cantidad]`;
                        cantidadInput.value = cantidad;
                        form.appendChild(cantidadInput);

                        hayPlatosSeleccionados = true;
                    }
                });

                if (!hayPlatosSeleccionados) {
                    // Mostrar modal en lugar de alert
                    $('#mensajeModalContent').text('El plato no debe ser menor a 0 si ya se hizo la venta oe :v');
                    $('#mensajeModal').modal('show');
                    return;
                }

                // Enviar el formulario mediante AJAX
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        $('#modal-action').modal('hide');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $('.text-danger').text('');
                            Object.keys(errors).forEach(function(key) {
                                $('#' + key).siblings('.text-danger').text(
                                    errors[key][0]);
                            });
                        } else {
                            alert(
                                "Error al guardar los cambios. Por favor, intente de nuevo."
                            );
                        }
                    }
                });
            });
        });
    });
</script>
@endpush
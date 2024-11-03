@extends('plantilla.app')

@section('contenido')
    <section class="content">
        <div class="container-fluid">
            <form id="ventaForm" action="{{ route('venta.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <div class="m-0">
                                <a class="btn btn-primary" href="{{ route('cliente.index') }}"><i class="fas fa-plus"></i>
                                    Añadir Cliente</a>
                            </div>
                            <label for="cliente_id">Cliente:</label>
                            <select name="cliente_id" id="cliente_id" class="form-control" required>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->usuario->nombres }} {{ $cliente->usuario->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-4 justify-content-center">
                            @foreach ($platos as $plato)
                                <div class="col-md-4 d-flex justify-content-center mb-4">
                                    <div class="card mx-3 my-2" style="width: 18rem;">
                                        @if ($plato->imagen_plato)
                                            <img src="{{ asset('platos/' . $plato->imagen_plato) }}" class="card-img-top"
                                                alt="{{ $plato->nombre_plato }}" style="min-height: 250px;">
                                        @endif
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $plato->nombre_plato }}</h5>
                                            <p class="card-text">
                                                Precio: S/. {{ number_format($plato->precio_plato, 2) }}<br>
                                            </p>
                                            <div class="form-group">
                                                @if ($plato->disponible == '1')
                                                    <label>Cantidad:</label>
                                                    <input type="number" name="platos[{{ $plato->id }}][cantidad]"
                                                        class="form-control cantidad-input" value="0" min="0"
                                                        data-precio="{{ $plato->precio_plato }}"
                                                        data-nombre="{{ $plato->nombre_plato }}">
                                                    <input type="hidden" name="platos[{{ $plato->id }}][id]"
                                                        value="{{ $plato->id }}">
                                                @else
                                                    <label style="color: red;">Plato no disponible</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4>Resumen de la Venta</h4>
                                <div id="detalle-venta" class="mt-3"></div>
                                <h4>Total de la Venta: S/. <span id="total">0.00</span></h4>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Registrar Venta</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>

        {{-- MODAL PARA CUANDO NO HAY PLATOS --}}
        <div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mensajeModalLabel">Información</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload()">
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cantidadInputs = document.querySelectorAll('.cantidad-input');
                const detalleVenta = document.getElementById('detalle-venta');
                const form = document.getElementById('ventaForm');

                function calcularTotal() {
                    let total = 0;
                    detalleVenta.innerHTML = '';

                    cantidadInputs.forEach(input => {
                        const cantidad = parseInt(input.value) || 0;
                        const precio = parseFloat(input.dataset.precio);
                        const nombrePlato = input.dataset.nombre;
                        const subtotal = cantidad * precio;

                        if (cantidad > 0) {
                            total += subtotal;

                            const detalleItem = document.createElement('div');
                            detalleItem.classList.add('detalle-item');
                            detalleItem.innerHTML = `
                    <p>${nombrePlato} - Cantidad: ${cantidad} - <b>Subtotal: S/. ${subtotal.toFixed(2)}</b></p>
                `;
                            detalleVenta.appendChild(detalleItem);
                        }
                    });

                    document.getElementById('total').textContent = total.toFixed(2);
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let hayPlatosSeleccionados = false;

                    // Crear inputs hidden para cada plato con cantidad > 0
                    cantidadInputs.forEach(input => {
                        const cantidad = parseInt(input.value) || 0;
                        const platoId = input.name.match(/\d+/)[0];

                        if (cantidad > 0) {
                            // Eliminar inputs hidden previos solo si hay platos seleccionados
                            if (!hayPlatosSeleccionados) {
                                form.querySelectorAll('input[name^="platos["]').forEach(input => input
                                    .remove());
                            }

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

                    // Si no hay platos seleccionados, mostrar el modal y detener el envío
                    if (!hayPlatosSeleccionados) {
                        $('#mensajeModalContent').text('Debe seleccionar al menos un plato');
                        $('#mensajeModal').modal('show');
                        return;
                    }

                    // Enviar el formulario
                    form.submit();
                });

                cantidadInputs.forEach(input => {
                    input.addEventListener('change', calcularTotal);
                    input.addEventListener('keyup', calcularTotal);
                });
            });
        </script>
    @endpush
@endsection

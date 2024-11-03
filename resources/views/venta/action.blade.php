<div class="modal-content ">
    <form id="VentasForm" action="{{ route('venta.update', $venta->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">EDITAR VENTA DEL CLIENTE: {{ $venta->cliente->usuario->nombres }} {{ $venta->cliente->usuario->apellidos }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col justify-content-center">
            <div class="row">
                <div class="modal-body">
                    <label for="cliente_id">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        @foreach ($clientes as $cli)
                            @if ($cli->usuario->id === $venta->cliente->usuario->id)
                                <option value="{{ $cli->id }}" selected>
                                    {{ $cli->usuario->nombres }} {{ $cli->usuario->apellidos }}
                                </option>
                            @else
                                <option value="{{ $cli->id }}">
                                    {{ $cli->usuario->nombres }} {{ $cli->usuario->apellidos }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    <div>
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required
                            value="{{ $venta->fecha }}">
                    </div>
                    <div>
                        <label for="total">Total Consumido:</label>
                        <input type="text" class="form-control" id="total" name="total" readonly
                            value="{{ number_format($venta->total, 2) }}">
                    </div>
                </div>


            </div>
            <div class="row mb-4 justify-content-center">
                @foreach ($venta->detalles as $detalle)
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card mx-3 my-2" style="width: 18rem;">
                            @if ($detalle->plato->imagen_plato)
                                <img src="{{ asset('platos/' . $detalle->plato->imagen_plato) }}" class="card-img-top"
                                    alt="{{ $detalle->plato->nombre_plato }}" style="height: 150px; width:200px">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $detalle->plato->nombre_plato }}</h5>
                                <p class="card-text">
                                    Precio: S/. {{ number_format($detalle->plato->precio_plato, 2) }}<br>
                                </p>
                                <input type="hidden" name="platos[{{ $detalle->plato->id }}][precio_unitario]"
                                    value="{{ $detalle->plato->precio_plato }}">
                                <div class="form-group">
                                    <label>Cantidad:</label>
                                    <input type="number" name="platos[{{ $detalle->plato->id }}][cantidad]"
                                        class="form-control cantidad-input" value="{{ $detalle->cantidad }}"
                                        min="0" data-precio="{{ $detalle->plato->precio_plato }}"
                                        data-nombre="{{ $detalle->plato->nombre_plato }}">
                                    <input type="hidden" name="platos[{{ $detalle->plato->id }}][id]"
                                        value="{{ $detalle->plato->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="modal-footer">
            <input type="hidden" name="venta_id" value="{{ $venta->id }}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>

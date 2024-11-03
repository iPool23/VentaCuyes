<!-- MODAL DETALLES -->
<div class="modal fade" id="modal-detalles-{{ $venta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalLabel{{ $venta->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $venta->id }}">Detalles de la Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>ID de Venta:</strong> {{ $venta->id }}</p>
                <p><strong>Cliente:</strong> {{ $venta->cliente->Usuario->nombres }}
                    {{ $venta->cliente->Usuario->apellidos }}</p>
                <p><strong>DNI:</strong> {{ $venta->cliente->dni }}</p>
                <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
                <p><strong>Platos comprados:</strong></p>
                <ul>
                    @foreach ($venta->detalles as $detalle)
                        <!-- Asumiendo que tienes una relación de detalles -->
                        <li>{{ $detalle->plato->nombre_plato }} - Cantidad: {{ $detalle->cantidad }} - Precio: S/.
                            {{ number_format($detalle->subtotal, 2) }}</li>
                    @endforeach
                </ul>
                <p><strong>Total consumido:</strong> S/. {{ number_format($venta->total, 2) }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL DETALLES -->

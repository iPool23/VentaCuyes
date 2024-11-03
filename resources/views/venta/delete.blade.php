<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar-{{ $venta->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-eliminar-label-{{ $venta->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('venta.toggle-disponible', $venta->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-eliminar-label-{{ $venta->id }}">Eliminar Venta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar la venta {{ $venta->id }}?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL ELIMINAR -->
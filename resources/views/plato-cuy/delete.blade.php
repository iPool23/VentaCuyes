<div class="modal fade" id="modal-eliminar-{{ $plato->id }}" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('plato-cuy.destroy', $plato->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Plato</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ $plato->imagen_plato ? asset('platos/'.$plato->imagen_plato) : asset('img/no-image.png') }}"
                            class="img-thumbnail"
                            style="max-width: 150px;"
                            alt="{{ $plato->nombre_plato }}">
                    </div>
                    <p class="mb-0">¿Está seguro que desea eliminar el plato "{{ $plato->nombre_plato }}"?</p>
                    <small class="text-white-50">Esta acción no se puede deshacer</small>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
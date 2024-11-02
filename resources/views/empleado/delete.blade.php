<div class="modal fade" id="modal-eliminar-{{ $reg->id }}">
    <div class="modal-dialog">
        <form action="{{ route('empleado.destroy', $reg->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-danger">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ $reg->imagen_perfil ? asset('empleados/'.$reg->imagen_perfil) : asset('img/user-avatar.png') }}"
                            class="rounded-circle border"
                            style="width: 100px; height: 100px; object-fit: cover;"
                            alt="{{ $reg->usuario->nombres }}">
                    </div>
                    <p>¿Está seguro que desea eliminar al empleado {{ $reg->usuario->nombres }} {{ $reg->usuario->apellidos }}?</p>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Empleado</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea eliminar al empleado {{ $reg->usuario->nombres }} {{ $reg->usuario->apellidos }}?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
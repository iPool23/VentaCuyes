@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin') 
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Usuarios 
                            <button class="btn btn-primary" id="btnNuevo"><i class="fas fa-user-plus"></i> Nuevo</button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('usuario.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input name="texto" type="text" class="form-control" value="{{ $texto }}" placeholder="Buscar usuarios...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </form>

                        @if(Session::has('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <span class="alert-icon"><i class="fa fa-info-circle"></i></span>
                            <span class="alert-text">{{ Session::get('mensaje') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <span class="alert-icon"><i class="fa fa-exclamation-triangle"></i></span>
                            <span class="alert-text">{{ Session::get('error') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(count($registros) == 0)
                        <div class="alert alert-secondary" role="alert">
                            No hay registros para mostrar
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registros as $reg)
                                    <tr>
                                        <td>
                                            <button class="btn btn-warning btn-sm btnEditar" data-id="{{ $reg->id }}"><i class="fas fa-edit"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#modal-eliminar-{{ $reg->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </td>
                                        <td>{{ $reg->nombres }}</td>
                                        <td>{{ $reg->apellidos }}</td>
                                        <td>{{ $reg->usuario }}</td>
                                        <td>{{ $reg->email }}</td>
                                        <td>{{ $reg->getRoleNames()->isNotEmpty() ? $reg->getRoleNames()->implode(', ') : 'Sin rol' }}</td>
                                    </tr>
                                    @include('usuario.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $registros->appends(["texto" => $texto])->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE -->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg"></div>
</div>

@else
<div class="alert alert-danger">
    No tienes permiso para acceder a esta sección.
</div>
@endhasanyrole

<!-- FIN MODAL UPDATE -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#liUsuarios').addClass("menu-open");
        $('#liUsuario').addClass("active");
        $('#aUsuarios').addClass("active");

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

        // Botón Nuevo
        $('#btnNuevo').on('click', function(e) {
            e.preventDefault();
            loadForm("{{ route('usuario.create') }}");
        });

        // Botón Editar
        $(document).on('click', '.btnEditar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            loadForm("{{ url('usuario') }}/" + id + "/edit");
        });

        // Manejar el envío del formulario
        $(document).on('submit', '#usuarioForm', function(e) {
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
                            $('#' + key).siblings('.text-danger').text(errors[key][0]);
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
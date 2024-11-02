@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin|empleado') 
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Proveedores 
                            <button class="btn btn-primary" id="btnNuevo">
                                <i class="fas fa-user-plus"></i> Nuevo Proveedor
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('proveedor.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input name="texto" type="text" class="form-control" 
                                    value="{{ $texto }}" placeholder="Buscar proveedores...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
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
                            <div class="alert alert-secondary">No hay registros para mostrar</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>RUC</th>
                                            <th>Razón Social</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($registros as $reg)
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning btn-sm btnEditar" 
                                                    data-id="{{ $reg->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#modal-eliminar-{{ $reg->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td>{{ $reg->usuario->nombres }}</td>
                                            <td>{{ $reg->usuario->apellidos }}</td>
                                            <td>{{ $reg->ruc }}</td>
                                            <td>{{ $reg->razon_social }}</td>
                                            <td>{{ $reg->telefono }}</td>
                                            <td>{{ $reg->direccion }}</td>
                                        </tr>
                                        @include('proveedor.delete')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $registros->appends(['texto' => $texto])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear/editar -->
<div class="modal fade" id="modal-action" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg"></div>
</div>

@else
<div class="alert alert-danger">
    No tienes permiso para acceder a esta sección.
</div>
@endhasanyrole

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#liProveedores').addClass("menu-open");
    $('#liProveedor').addClass("active");
    $('#aProveedores').addClass("active");

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
                alert("Error al cargar el formulario");
            }
        });
    }

    $('#btnNuevo').on('click', function(e) {
        e.preventDefault();
        loadForm("{{ route('proveedor.create') }}");
    });

    $(document).on('click', '.btnEditar', function(e) {
        e.preventDefault();
        loadForm("{{ url('proveedor') }}/" + $(this).data('id') + "/edit");
    });

    $(document).on('submit', '#proveedorForm', function(e) {
        e.preventDefault();
        var form = $(this);
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#modal-action').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('.text-danger').text('');
                    Object.keys(errors).forEach(function(key) {
                        $('#' + key).siblings('.text-danger').text(errors[key][0]);
                    });
                } else {
                    alert("Error al procesar la solicitud");
                }
            }
        });
    });
});
</script>
@endpush
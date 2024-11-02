@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Empleados
                            <button class="btn btn-primary" id="btnNuevo">
                                <i class="fas fa-user-plus"></i> Nuevo Empleado
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('empleado.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input name="texto" type="text" class="form-control"
                                    value="{{ $texto }}" placeholder="Buscar empleados...">
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
                                        <th>Foto</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Fecha Contratación</th>
                                        <th>Salario</th>
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
                                        <td>
                                            <img src="{{ $reg->imagen_perfil ? asset('empleados/'.$reg->imagen_perfil) : asset('img/user-avatar.png') }}"
                                                class="rounded-circle"
                                                style="width: 40px; height: 40px; object-fit: cover;"
                                                alt="{{ $reg->usuario->nombres }}">
                                        </td>
                                        <td>{{ $reg->usuario->nombres }}</td>
                                        <td>{{ $reg->usuario->apellidos }}</td>
                                        <td>{{ $reg->dni }}</td>
                                        <td>{{ $reg->telefono }}</td>
                                        <td>{{ $reg->direccion }}</td>
                                        <td>{{ date('d/m/Y', strtotime($reg->fecha_contratacion)) }}</td>
                                        <td>S/. {{ number_format($reg->salario, 2) }}</td>
                                    </tr>
                                    @include('empleado.delete')
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
        // Menu active states
        $('#liEmpleados').addClass("menu-open");
        $('#liEmpleado').addClass("active");
        $('#aEmpleados').addClass("active");

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
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al cargar el formulario',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        // New button handler
        $('#btnNuevo').on('click', function(e) {
            e.preventDefault();
            loadForm("{{ route('empleado.create') }}");
        });

        // Edit button handler
        $(document).on('click', '.btnEditar', function(e) {
            e.preventDefault();
            loadForm("{{ url('empleado') }}/" + $(this).data('id') + "/edit");
        });

        // Form submission handler
        $(document).on('submit', '#empleadoForm', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-action').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        Object.keys(errors).forEach(function(key) {
                            $('#' + key).siblings('.text-danger').text(errors[key][0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Error al procesar la solicitud',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });

        // Image preview handler
        $(document).on('change', '#imagen_perfil', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $(this).next('.custom-file-label').html(file.name);
            }
        });
    });
</script>
@endpush
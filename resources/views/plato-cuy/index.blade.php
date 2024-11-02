@extends('plantilla.app')

@section('contenido')
@hasanyrole('admin|empleado')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Platos de Cuy
                            <button class="btn btn-primary" id="btnNuevo">
                                <i class="fas fa-plus"></i> Nuevo Plato
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('plato-cuy.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input name="texto" type="text" class="form-control"
                                    value="{{ $texto }}" placeholder="Buscar platos...">
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

                        @if(count($platos) == 0)
                        <div class="alert alert-secondary">No hay platos registrados</div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre del Plato</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Tiempo Prep.</th>
                                        <th>Proveedor</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($platos as $plato)
                                    <tr>
                                        <td>
                                            <img src="{{ $plato->imagen_plato ? asset('platos/'.$plato->imagen_plato) : asset('img/no-image.png') }}"
                                                class="img-thumbnail"
                                                style="width: 50px; height: 50px; object-fit: cover;"
                                                alt="{{ $plato->nombre_plato }}">
                                        </td>
                                        <td>{{ $plato->nombre_plato }}</td>
                                        <td>{{ $plato->tipo_preparacion }}</td>
                                        <td>S/. {{ number_format($plato->precio_plato, 2) }}</td>
                                        <td>{{ $plato->tiempo_preparacion }} min</td>
                                        <td>{{ $plato->proveedor->razon_social }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    class="custom-control-input toggle-disponible"
                                                    id="disponible{{ $plato->id }}"
                                                    {{ $plato->disponible ? 'checked' : '' }}
                                                    data-id="{{ $plato->id }}">
                                                <label class="custom-control-label"
                                                    for="disponible{{ $plato->id }}">
                                                    {{ $plato->disponible ? 'Disponible' : 'No disponible' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm btnEditar"
                                                data-id="{{ $plato->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#modal-eliminar-{{ $plato->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('plato-cuy.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $platos->appends(['texto' => $texto])->links() }}
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
        // Menú activo
        $('#liPlatos').addClass("menu-open");
        $('#liPlatoCuy').addClass("active");
        $('#aPlatos').addClass("active");

        // Cargar formulario
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

        // Botón Nuevo
        $('#btnNuevo').on('click', function(e) {
            e.preventDefault();
            loadForm("{{ route('plato-cuy.create') }}");
        });

        // Botón Editar
        $(document).on('click', '.btnEditar', function(e) {
            e.preventDefault();
            loadForm("{{ url('plato-cuy') }}/" + $(this).data('id') + "/edit");
        });

        $('.toggle-disponible').change(function() {
            const id = $(this).data('id');
            const checkbox = $(this);

            $.ajax({
                url: `{{ url('plato-cuy') }}/${id}/toggle-disponible`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    const label = checkbox.siblings('label');
                    label.text(response.disponible ? 'Disponible' : 'No disponible');

                    Swal.fire({
                        icon: 'success',
                        title: 'Estado actualizado',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    checkbox.prop('checked', !checkbox.prop('checked')); // Revert change
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al cambiar disponibilidad',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Submit Form
        $(document).on('submit', '#platoCuyForm', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
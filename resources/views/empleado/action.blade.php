<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ isset($empleado->id) ? 'Editar Empleado' : 'Crear Empleado' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="empleadoForm" action="{{ isset($empleado->id) ? route('empleado.update', $empleado->id) : route('empleado.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($empleado->id))
        @method('PUT')
        @endif
        <div class="modal-body">
            <!-- Datos de Usuario -->
            <div class="row">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <img id="preview"
                            src="{{ $empleado->imagen_perfil ? asset('empleados/'.$empleado->imagen_perfil) : asset('img/user-avatar.png') }}"
                            class="rounded-circle border shadow-sm"
                            style="width: 120px; height: 120px; object-fit: cover;">

                        <div class="mt-3">
                            <div class="custom-file" style="max-width: 300px;">
                                <input type="file" class="custom-file-input" id="imagen_perfil" name="imagen_perfil"
                                    accept="image/jpeg,image/png,image/jpg">
                                <label class="custom-file-label" for="imagen_perfil">Elegir foto</label>
                            </div>
                            <small class="text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres"
                            value="{{ old('nombres', $empleado->usuario->nombres ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            value="{{ old('apellidos', $empleado->usuario->apellidos ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            @if(!isset($empleado->id))
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>
            @endif

            <!-- Datos de Empleado -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni"
                            value="{{ old('dni', $empleado->dni ?? '') }}" required maxlength="8">
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono"
                            value="{{ old('telefono', $empleado->telefono ?? '') }}" required maxlength="9">
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion"
                    value="{{ old('direccion', $empleado->direccion ?? '') }}" required>
                <small class="text-danger"></small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_contratacion">Fecha de Contratación</label>
                        <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion"
                            value="{{ old('fecha_contratacion', $empleado->fecha_contratacion ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="salario">Salario</label>
                        <input type="number" step="0.01" class="form-control" id="salario" name="salario"
                            value="{{ old('salario', $empleado->salario ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">
                {{ isset($empleado->id) ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('imagen_perfil').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview').src = event.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
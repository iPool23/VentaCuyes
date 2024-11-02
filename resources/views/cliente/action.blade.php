<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ isset($cliente->id) ? 'Editar Cliente' : 'Crear Cliente' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="clienteForm" action="{{ isset($cliente->id) ? route('cliente.update', $cliente->id) : route('cliente.store') }}" method="POST">
        @csrf
        @if(isset($cliente->id))
            @method('PUT')
        @endif
        <div class="modal-body">
            <!-- Datos de Usuario -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" 
                            value="{{ old('nombres', $cliente->usuario->nombres ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" 
                            value="{{ old('apellidos', $cliente->usuario->apellidos ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            @if(!isset($cliente->id))
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

            <!-- Datos de Cliente -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" 
                            value="{{ old('dni', $cliente->dni ?? '') }}" required maxlength="8">
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" 
                            value="{{ old('telefono', $cliente->telefono ?? '') }}" required maxlength="9">
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" 
                    value="{{ old('direccion', $cliente->direccion ?? '') }}" required>
                <small class="text-danger"></small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">
                {{ isset($cliente->id) ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>
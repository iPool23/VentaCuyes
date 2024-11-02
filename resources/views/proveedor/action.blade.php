<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ isset($proveedor->id) ? 'Editar Proveedor' : 'Crear Proveedor' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="proveedorForm" action="{{ isset($proveedor->id) ? route('proveedor.update', $proveedor->id) : route('proveedor.store') }}" method="POST">
        @csrf
        @if(isset($proveedor->id))
            @method('PUT')
        @endif
        <div class="modal-body">
            <!-- Datos de Usuario -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" 
                            value="{{ old('nombres', $proveedor->usuario->nombres ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" 
                            value="{{ old('apellidos', $proveedor->usuario->apellidos ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            @if(!isset($proveedor->id))
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

            <!-- Datos de Proveedor -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ruc">RUC</label>
                        <input type="text" class="form-control" id="ruc" name="ruc" 
                            value="{{ old('ruc', $proveedor->ruc ?? '') }}" required maxlength="11">
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="razon_social">Razón Social</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" 
                            value="{{ old('razon_social', $proveedor->razon_social ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" 
                            value="{{ old('telefono', $proveedor->telefono ?? '') }}" required maxlength="9">
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" 
                            value="{{ old('direccion', $proveedor->direccion ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">
                {{ isset($proveedor->id) ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>
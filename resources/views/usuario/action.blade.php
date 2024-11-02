<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">{{ isset($usuario) && $usuario->id ? 'Editar Usuario' : 'Crear Usuario' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="usuarioForm" action="{{ isset($usuario) && $usuario->id ? route('usuario.update', $usuario->id) : route('usuario.store') }}" method="POST">
        @csrf
        @if(isset($usuario) && $usuario->id)
        @method('PUT')
        @endif
        <div class="modal-body">
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $usuario->nombres ?? '') }}" required>
                @error('nombres')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $usuario->apellidos ?? '') }}" required>
                @error('apellidos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="{{ old('usuario', $usuario->usuario ?? '') }}" required>
                @error('usuario')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email ?? '') }}" required>
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select class="form-control" id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    @foreach($roles as $role)
                    <option value="{{ $role }}" {{ (isset($usuario) && $usuario->hasRole($role)) ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                    @endforeach
                </select>
                @error('rol')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" {{ isset($usuario) ? '' : 'required' }}>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($usuario) ? '' : 'required' }}>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">{{ isset($usuario) && $usuario->id ? 'Actualizar' : 'Crear' }}</button>
        </div>
    </form>
</div>
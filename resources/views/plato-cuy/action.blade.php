<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ isset($platoCuy->id) ? 'Editar Plato' : 'Nuevo Plato' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="platoCuyForm" action="{{ isset($platoCuy->id) ? route('plato-cuy.update', $platoCuy->id) : route('plato-cuy.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($platoCuy->id))
        @method('PUT')
        @endif
        <div class="modal-body">
            <div class="row">
                <!-- Imagen Preview -->
                <div class="col-md-12 text-center mb-3">
                    <img id="preview"
                        src="{{ $platoCuy->imagen_plato ? asset('platos/'.$platoCuy->imagen_plato) : asset('img/no-image.png') }}"
                        class="img-thumbnail"
                        style="max-height: 200px;">
                </div>

                <!-- Imagen Upload -->
                <div class="col-md-12 mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagen_plato" name="imagen_plato"
                            accept="image/jpeg,image/png,image/jpg">
                        <label class="custom-file-label" for="imagen_plato">Elegir imagen</label>
                    </div>
                    <small class="text-danger"></small>
                </div>

                <!-- Nombre del Plato -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre_plato">Nombre del Plato</label>
                        <input type="text" class="form-control" id="nombre_plato" name="nombre_plato"
                            value="{{ old('nombre_plato', $platoCuy->nombre_plato ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Tipo de Preparación -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_preparacion">Tipo de Preparación</label>
                        <select class="form-control" id="tipo_preparacion" name="tipo_preparacion" required>
                            <option value="">Seleccione...</option>
                            @foreach(App\Models\PlatoCuy::tiposPreparacion() as $tipo)
                            <option value="{{ $tipo }}"
                                {{ old('tipo_preparacion', $platoCuy->tipo_preparacion ?? '') == $tipo ? 'selected' : '' }}>
                                {{ $tipo }}
                            </option>
                            @endforeach
                        </select>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="proveedor_id">Proveedor</label>
                        <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                            <option value="">Seleccione...</option>
                            @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id', $platoCuy->proveedor_id ?? '') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->razon_social }}
                            </option>
                            @endforeach
                        </select>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Precio -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="precio_plato">Precio (S/.)</label>
                        <input type="number" step="0.01" class="form-control" id="precio_plato" name="precio_plato"
                            value="{{ old('precio_plato', $platoCuy->precio_plato ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Tiempo de Preparación -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tiempo_preparacion">Tiempo de Preparación (min)</label>
                        <input type="number" class="form-control" id="tiempo_preparacion" name="tiempo_preparacion"
                            value="{{ old('tiempo_preparacion', $platoCuy->tiempo_preparacion ?? '') }}" required>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $platoCuy->descripcion ?? '') }}</textarea>
                        <small class="text-danger"></small>
                    </div>
                </div>

                <!-- Ingredientes -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ingredientes">Ingredientes</label>
                        <textarea class="form-control" id="ingredientes" name="ingredientes" rows="3">{{ old('ingredientes', $platoCuy->ingredientes ?? '') }}</textarea>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">{{ isset($platoCuy->id) ? 'Actualizar' : 'Guardar' }}</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('imagen_plato').addEventListener('change', function(e) {
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
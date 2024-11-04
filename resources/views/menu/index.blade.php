@extends('plantilla.app')

@section('contenido')
<div class="container py-4">
    <h1 class="text-center mb-4">Carta del Restaurante</h1>
    
    <div class="row">
        @forelse($platos as $plato)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('platos/'.$plato->imagen_plato) }}" 
                     class="card-img-top" 
                     alt="{{ $plato->nombre_plato }}"
                     style="height: 200px; object-fit: cover;">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $plato->nombre_plato }}</h5>
                    <p class="card-text text-muted">{{ $plato->tipo_preparacion }}</p>
                    <p class="card-text">{{ $plato->descripcion }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">S/. {{ number_format($plato->precio_plato, 2) }}</span>
                        <span class="badge bg-info">
                            <i class="fas fa-clock"></i> {{ $plato->tiempo_preparacion }} min
                        </span>
                    </div>

                    @if($plato->ingredientes)
                    <hr>
                    <small class="text-muted">
                        <strong>Ingredientes:</strong> {{ $plato->ingredientes }}
                    </small>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No hay platos disponibles en este momento.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    transition: transform 0.2s;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endpush
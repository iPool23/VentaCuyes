<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatoCuy extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'platos_cuy';

    protected $fillable = [
        'proveedor_id',
        'nombre_plato',
        'tipo_preparacion',
        'descripcion',
        'precio_plato',
        'tiempo_preparacion',
        'disponible',
        'ingredientes',
        'imagen_plato'
    ];

    protected $casts = [
        'precio_plato' => 'decimal:2',
        'disponible' => 'boolean',
        'tiempo_preparacion' => 'integer'
    ];

    // Relación con proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    // Tipos de preparación disponibles
    public static function tiposPreparacion()
    {
        return [
            'Cuy Chactado',
            'Cuy al Horno',
            'Cuy Frito',
            'Cuy al Palo',
            'Pepián de Cuy'
        ];
    }
}
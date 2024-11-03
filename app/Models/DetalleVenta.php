<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    protected $table = 'detalle_ventas'; // Nombre de la tabla

    protected $fillable = [
        'venta_id',
        'plato_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
    
    public function plato()
    {
        return $this->belongsTo(PlatoCuy::class, 'plato_id');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'usuario_id',
        'ruc',
        'razon_social',
        'telefono',
        'direccion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
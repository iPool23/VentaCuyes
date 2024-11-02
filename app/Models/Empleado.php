<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'dni',
        'telefono',
        'direccion',
        'fecha_contratacion',
        'salario',
        'imagen_perfil'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}

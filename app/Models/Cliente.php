<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'dni', 'telefono', 'direccion'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}

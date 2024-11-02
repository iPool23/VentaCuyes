<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'usuarios'; 

    protected $guard_name = 'usuario';

    protected $fillable = [
        'nombres',
        'apellidos',
        'usuario',
        'email',
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value); 
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class);
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class);
    }
}

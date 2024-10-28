<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "usuarios"; 

    protected $fillable = [
        'nombres',
        'apellidos',
        'usuario',
        'email',
        'password',
        'rol',
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
}

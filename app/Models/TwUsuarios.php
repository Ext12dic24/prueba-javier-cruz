<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class TwUsuarios extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'username', 'email', 'password', 'S_Nombre', 'S_Apellidos', 'S_FotoPerfilUrl', 'S_Activo'
    ];

    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

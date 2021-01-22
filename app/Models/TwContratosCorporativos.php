<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwContratosCorporativos extends Model
{
    use HasFactory;

    protected $dates = [
        'D_FechaInicio',
        'D_FechaFin'
    ];
}

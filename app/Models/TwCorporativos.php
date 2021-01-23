<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\CorporativosFactory;

class TwCorporativos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = [
        'D_FechaIncorporacion',
        'deleted_at'
    ];

    protected static function newFactory()
    {
        return CorporativosFactory::new();
    }
}

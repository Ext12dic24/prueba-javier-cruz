<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TwEmpresasCorporativos extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $dates = [
        'deleted_at'
    ];

    public function tw_corporativos()
    {
        return $this->belongsTo(TwCorporativos::class, 'tw_corporativos_id');
    }
}

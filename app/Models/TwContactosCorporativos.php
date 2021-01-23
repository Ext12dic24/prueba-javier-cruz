<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwContactosCorporativos extends Model
{
    use HasFactory;

    public function tw_corporativos()
    {
        return $this->belongsTo(TwCorporativos::class, 'tw_corporativos_id');
    }
}

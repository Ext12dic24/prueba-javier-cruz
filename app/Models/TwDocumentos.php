<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwDocumentos extends Model
{
    use HasFactory;

    public function tw_documentos_corporativos_asociados()
    {
        return $this->hasMany(TwDocumentosCorporativos::class, 'tw_documentos_id');
    }
}

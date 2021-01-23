<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwDocumentosCorporativos extends Model
{
    use HasFactory;

    public function tw_corporativo()
    {
        return $this->belongsTo(TwCorporativos::class, 'tw_corporativos_id');
    }

    public function tw_documento()
    {
        return $this->belongsTo(TwDocumentos::class, 'tw_documentos_id');
    }
}

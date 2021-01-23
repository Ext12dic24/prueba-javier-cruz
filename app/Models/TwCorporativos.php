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

    public function tw_contactos_corporativos()
    {
        return $this->hasMany(TwContactosCorporativos::class, 'tw_corporativos_id');
    }

    public function tw_contratos_corporativos()
    {
        return $this->hasMany(TwContratosCorporativos::class, 'tw_corporativos_id');
    }

    public function tw_empresas_corporativos()
    {
        return $this->hasMany(TwEmpresasCorporativos::class, 'tw_corporativos_id');
    }

    public function tw_documentos_corporativos()
    {
        return $this->hasMany(TwDocumentosCorporativos::class, 'tw_corporativos_id');
    }
}

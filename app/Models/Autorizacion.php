<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    use HasFactory;

    protected $table = 'autorizaciones';
    protected $primaryKey = 'id_autorizacion';
    public $timestamps = false; // Legacy tables usually don't have created_at/updated_at by default

    protected $fillable = [
        'nro_kardex',
        'encargado',
        'id_tppermi',
        'fecha_ingreso',
        'viaja_a',
        'id_tpdoc_acomp',
        'num_doc_acomp',
        'nombres_acomp',
        'apellidos_acomp',
        'id_tpdoc_resp',
        'num_doc_resp',
        'nombres_resp',
        'apellidos_resp',
        'id_tptrans',
        'agencia_transporte',
        'tiempo_viaje',
        'observaciones',
    ];

    public function tipoPermiso()
    {
        return $this->belongsTo(TipoPermiso::class, 'id_tppermi');
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'personas_autorizaciones', 'id_autorizacion', 'id_persona')
            ->withPivot('id_tp_relacion', 'firma');
    }
}

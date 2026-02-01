<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    use HasFactory;

    protected $table = 'autorizaciones';
    protected $primaryKey = 'id_autorizacion';
    public $timestamps = false;

    protected $casts = [
        'fecha_ingreso' => 'date',
    ];

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

    public function setEncargadoAttribute($value)
    {
        $this->attributes['encargado'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setViajaAAttribute($value)
    {
        $this->attributes['viaja_a'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setNombresAcompAttribute($value)
    {
        $this->attributes['nombres_acomp'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setApellidosAcompAttribute($value)
    {
        $this->attributes['apellidos_acomp'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setNombresRespAttribute($value)
    {
        $this->attributes['nombres_resp'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setApellidosRespAttribute($value)
    {
        $this->attributes['apellidos_resp'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setAgenciaTransporteAttribute($value)
    {
        $this->attributes['agencia_transporte'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setTiempoViajeAttribute($value)
    {
        $this->attributes['tiempo_viaje'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setObservacionesAttribute($value)
    {
        $this->attributes['observaciones'] = mb_strtoupper($value, 'UTF-8');
    }

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

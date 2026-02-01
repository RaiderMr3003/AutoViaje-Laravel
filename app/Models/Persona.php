<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    public $timestamps = false;

    protected $fillable = [
        'id_tpdoc',
        'num_doc',
        'apellidos',
        'nombres',
        'edad',
        'tipo_edad',
        'id_nacionalidad',
        'id_ubigeo',
        'direccion',
        'es_menor',
    ];

    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = mb_strtoupper($value, 'UTF-8');
    }

    public function setTipoEdadAttribute($value)
    {
        $this->attributes['tipo_edad'] = mb_strtoupper($value, 'UTF-8');
    }

    public function autorizaciones()
    {
        return $this->belongsToMany(Autorizacion::class, 'personas_autorizaciones', 'id_persona', 'id_autorizacion')
            ->withPivot('id_tp_relacion', 'firma');
    }

    /**
     * Personas representadas por esta persona.
     */
    public function representados()
    {
        return $this->belongsToMany(Persona::class, 'representantes', 'id_representante', 'id_representado');
    }

    /**
     * Personas que representan a esta persona.
     */
    public function representantes()
    {
        return $this->belongsToMany(Persona::class, 'representantes', 'id_representado', 'id_representante');
    }
}

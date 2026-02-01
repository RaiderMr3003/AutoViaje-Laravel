<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;

    protected $table = 'ubigeo';
    protected $primaryKey = 'id_ubigeo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_ubigeo',
        'nom_dis',
        'nom_prov',
        'nom_dpto',
        'cod_dist',
        'cod_prov',
        'cod_dpto'
    ];

    public function getFullLocationAttribute()
    {
        return "{$this->nom_dis} / {$this->nom_prov} / {$this->nom_dpto}";
    }
}

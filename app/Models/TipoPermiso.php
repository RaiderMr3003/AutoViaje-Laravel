<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPermiso extends Model
{
    use HasFactory;

    protected $table = 'tp_permiso';
    protected $primaryKey = 'id_tppermi';
    public $timestamps = false;

    protected $fillable = ['des_tppermi'];
}

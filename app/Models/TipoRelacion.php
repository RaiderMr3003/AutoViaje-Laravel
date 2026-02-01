<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRelacion extends Model
{
    use HasFactory;

    protected $table = 'tp_relacion';
    protected $primaryKey = 'id_tp_relacion';
    public $timestamps = false;

    protected $fillable = ['descripcion'];
}

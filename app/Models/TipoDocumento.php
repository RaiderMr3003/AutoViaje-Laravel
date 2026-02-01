<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tp_documento';
    protected $primaryKey = 'id_tpdoc';
    public $timestamps = false;

    protected $fillable = ['des_tpdoc'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTransporte extends Model
{
    use HasFactory;

    protected $table = 'tp_transporte';
    protected $primaryKey = 'id_tptrans';
    public $timestamps = false;

    protected $fillable = ['des_tptrans'];
}

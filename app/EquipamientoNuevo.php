<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipamientoNuevo extends Model
{
    use SoftDeletes;
    protected $table      = "equipamientoNuevo";
    protected $fillable = [
        'id', 'user_id',  'departamento_eu', 'departamento_es', 'equipo_eu', 'equipo_es', 'institucion',  'importe'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramasDeIntercambio extends Model
{
    protected $table      = "programasDeIntercambio";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'lugar', 'actividad_eu', 'actividad_es',  'desde',  'hasta'
    ];

    public function profesores()
    {
        return $this->belongsToMany(Autor::class, 'programasDeIntercambiosProfesores', 'id_programaIntercambio', 'id_autor');
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }

}
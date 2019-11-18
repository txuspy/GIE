<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Congresos extends Model
{
    use SoftDeletes;
    protected $table      = "congresos";
    protected $fillable = [
        'id', 'user_id',  'congreso_eu', 'congreso_es', 'conferenciaPoster', 'lugar', 'desde',  'hasta', 'ekarpena'
    ];

    public function profesores()
    {
        return $this->belongsToMany(Autor::class, 'congresosProfesores', 'id_congreso', 'id_autor');
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }

}
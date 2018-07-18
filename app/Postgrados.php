<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postgrados extends Model
{
    protected $table      = "postgrados";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'departamento', 'titulo_eu', 'titulo_es', 'curso_eu', 'curso_es', 'duracion',  'lugar'
    ];


    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'postgradosAutores', 'id_postgrado', 'id_autor');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}
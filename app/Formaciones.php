<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formaciones extends Model
{
    protected $table      = "formaciones";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'modo',  'titulo_eu', 'titulo_es', 'organizador_eu','organizador_es', 'lugar', 'duracion','fecha'
    ];


    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'formacionesAutores', 'id_formacion', 'id_autor');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicaciones extends Model
{
    protected $table      = "publicaciones";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'titulo_eu', 'titulo_es', 'editorialRevisa', 'capitulo', 'volumen',  'year', 'ISBN'
    ];


    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'publicacionesAutores', 'id_publicacion', 'id_autor');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}
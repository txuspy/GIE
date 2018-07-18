<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitas extends Model
{
    protected $table      = "visitas";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id',  'titulo_eu', 'titulo_es', 'lugar', 'fecha'
    ];


    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'visitasAutores', 'id_visita', 'id_autor');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}
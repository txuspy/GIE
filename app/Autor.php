<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Proyectos;

class Autor extends Model
{
   protected $table = "autores";
   protected $fillable = [
        'id', 'user_id',  'nombre', 'apellido', 'id_autor'
    ];


}

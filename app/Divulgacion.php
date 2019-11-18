<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Autor;

class Divulgacion extends Model
{
    use SoftDeletes;
    protected $table      = "divulgacion";
    protected $fillable   = [
        'id', 'user_id', 'tipo', 'titulo_eu', 'titulo_es', 'desc_eu', 'desc_es', 'fecha', 'hasta', 'web', 'komunikabideetanPublikatua', 'komunikabidea', 'komunikabideWeb'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipamientoNuevo extends Model
{
    use SoftDeletes;
    protected $table      = "equipamientoNuevo";
    protected $fillable = [
        'id', 'user_id',  'departamento',  'hornikuntza', 'ekipamendua', 'institucion',  'importe','data'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}
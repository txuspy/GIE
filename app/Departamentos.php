<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamentos extends Model
{

    protected $table      = "departamentos";
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable = [
        'id', 'tit_eu',  'tit_es'
    ];


}
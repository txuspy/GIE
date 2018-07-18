<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Lib\Functions;
use App\ClientesDirecciones;
use Carbon\Carbon;
use App\Http\Controllers\ImageController;
use App\Departamentos;

trait Listados
{
    public static function listadoDepartamentos($lng)
    {
        $tit = 'tit_'.$lng;

        $miArray =  Departamentos::orderBy($tit, 'ASC')->get();


        $valores[0] = __('Aukeratu');

        foreach ($miArray as $valor){
           // $valores[$valor->id]= $valor->$tit;
            $valores[$valor->id]= $valor->tit_eu." / ".$valor->tit_es;
        }
        return $valores;
    }

}

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
            $valores[$valor->id]= $valor->$tit;
            // $valores[$valor->id]= $valor->tit_eu." / ".$valor->tit_es;
        }
        return $valores;
    }

    public static function listadoEkarpena()
    {

        $miArray =
        [
        '1' => __('Hitzaldi gonbidatua'),
        '2' => __('Ahozkoaurkezpena'),
        '3' => __('Posterra')
        ];
        return $miArray;
    }

    public static function listadoEkarpenaESP()
    {

        $miArray =
        [
        '1' => __('Hitzaldi gonbidatua / Ponencia invitada'),
        '2' => __('Ahozkoaurkezpena / Comunicación oral'),
        '3' => __('Posterra / Poster')
        ];
        return $miArray;
    }

}

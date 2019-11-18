<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Lib\Functions;
use App\ClientesDirecciones;
use Carbon\Carbon;
use App\Http\Controllers\ImageController;

trait CrearDireccion{
    public static function direccion(Request $request, $id_cliente){
        //funcion corrdenadas desde direccion function transformAdderss($address, 'lng')
        $address = $request->direccion_direccion." ".$request->poblacion_direccion;

        $lng = Functions::transformAdderss($address, 'lng');
        $lat = Functions::transformAdderss($address, 'lat');

        $direccion = new ClientesDirecciones([
                'tipo_direccion'       => $request->tipo_direccion,
                'id_cliente'           => $id_cliente,
                'direccion_direccion'  => $request->direccion_direccion,
                'direccion_direccion2' => $request->direccion_direccion2,
                'poblacion_direccion'  => $request->poblacion_direccion,
                'pais_direccion'       => $request->pais_direccion,
                'cp_direccion'         => $request->cp_direccion,
                'mailing_direccion'    => $request->mailing_direccion,
                'lng_direccion'        => $lng,
                'lat_direccion'        => $lat,
                'fecha_direccion'      => Carbon::now(),
            ]);
        $direccion->save();
        $id_direccion = $direccion->id_direccion;
        return $id_direccion;
    }
    public static function imagenSmall($tipo, $id){
        $imagenes = new ImageController();
        $imagenes = $imagenes->dameImagenes( $tipo , $id, '1');
        if($imagenes){
            foreach ( $imagenes as $imagen){
               return $imagen->nom_imagenes;
            }
        }
        return false;
    }
}
trait ObtenerImg
{

}

<?php

namespace App\Lib;


class Functions
{

    public static function valorIsChequed($tipoTrabajo, $id)
    {
        $tipoEmpresas = explode('-', $tipoTrabajo);
        if ($tipoEmpresas) {
            $cont = 1;
            foreach ($tipoEmpresas as $key => $value) {
                if ($value != '') {
                    if ($value == $id) {
                        return true;
                    }
                }
            }

            return false;
        }
    }

    public static function transformAdderss($address, $type){
        //$gMapsApiKey=\Config::get('services.google.maps.api-key');
        $gMapsApiKey= config('services.google.maps.api-key');
        // dd( $gMapsApiKey );
        $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=".$gMapsApiKey."&address=".urlencode($address)."&sensor=false");
        $geo = json_decode($geo, true);

        if($geo["status"] == "OK"){
            //la direccion existe
            return $geo["results"][0]['geometry']['location'][$type];
        }else{
            //la direccion no existe
            return '';
        }
    }

    public static function getSql($q, $sql)
    {
        $replace = function ($sql, $bindings)
            {
                $needle = '?';
                foreach ($bindings as $replace){
                    $pos = strpos($sql, $needle);
                    if ($pos !== false) {
                        if (gettype($replace) === "string") {
                             $replace = ' "'.addslashes($replace).'" ';
                        }
                        $sql = substr_replace($sql, $replace, $pos, strlen($needle));
                    }
                }
                return $sql;
            };
            $sql =  $replace($q->toSql(), $q->getBindings()) ;

            return $sql;
    }
    private function modificarSql($sql)
    {
        //$newstr = substr_replace(($sql, '<br> de WHERE ', $pos, 0);
        $newsql = str_replace($sql, $sql.'<br> de WHERE ', 'where');
        return $newsql;
    }
    public static function parseLang()
    {
        $locale = \Request::segment(1);
        if (in_array($locale, config('app.supported-locales'))) {
            $lang = $locale;
        } else {
            if(!\Session::has('locale')){
                if (\Auth::guest()){
                    $lang = config('app.locale');
                }else{
                    $lang = \Auth::user()->lng;
                }
            }else{
                $lang = \Session::get('locale');
            }
        }
        \Session::put('locale', $lang );
        \Session::put('locale_key', array_search( $lang, config('app.supported-locales3') ));
        return $lang;
    }
    public static function arrayMonedas(){
        return [ '1' => 'Euro', '2' => 'Dolar', '3' => 'Corona Sueca'];
    }
    public static function arrayNombreMonedas($id){
        $monedas = self::arrayMonedas();
        return $monedas[$id];
    }
    public function workFiles($tipo)
    {
        $datos = array();
        switch ($tipo) {
            case 'usuarios':
                // Imagenes
                $datos['ruta'] = 'usuarios/';
                $datos['varible'] = 'id';
                $datos['pre'] = 'user_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '150';
                $datos['ta_Y'][1] = '150';
                $datos['ta_X'][2] = '300';
                $datos['ta_Y'][2] = '300';
                // Adjuntos
                $datos['ruta_adjunto'] = '/usuarios/';
                break;
            case 'producto':
                // Imagenes
                $datos['ruta'] = 'pro/';
                $datos['varible'] = 'id_producto';
                $datos['pre'] = 'pro_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '95';
                $datos['ta_Y'][1] = '95';
                $datos['ta_X'][2] = '300';
                $datos['ta_Y'][2] = '300';
                $datos['ta_X'][3] = '700';
                $datos['ta_Y'][3] = '500';
                // Adjuntos
                $datos['ruta_adjunto'] = '/productos/';

                break;
            case 'coleccion':
                // Imagenes
                $datos['ruta'] = 'col/';
                $datos['varible'] = 'id_coleccion';
                $datos['pre'] = 'col_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '125';
                $datos['ta_Y'][1] = '125';
                $datos['ta_X'][2] = '550';
                $datos['ta_Y'][2] = '400';
                // Adjuntos
                $datos['ruta_adjunto'] = '/categorias/';
                break;
            case 'mp':
                // Imagenes
                $datos['ruta'] = 'mp/';
                $datos['varible'] = 'id_mp';
                $datos['pre'] = 'mp_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '90';
                $datos['ta_Y'][1] = '65';
                $datos['ta_X'][2] = '550';
                $datos['ta_Y'][2] = '400';
                // Adjuntos
                $datos['ruta_adjunto'] = '/mp/';
                break;
            case 'contacto':
            //case 'cont':
                // Imagenes
                $datos['ruta'] = 'cont/';
                $datos['varible'] = 'id_contactos';
                $datos['pre'] = 'cont_';
                $datos['cuantos'] = '1';
                //Tamaños
                $datos['ta_X'][1] = '125';
                $datos['ta_Y'][1] = '95';

                // Adjuntos
                $datos['ruta_adjunto'] = '/cont/';
                break;
            case 'makina':
                // Imagenes
                $datos['ruta'] = 'makinaria/';
                $datos['varible'] = 'id_makinaria';
                $datos['pre'] = 'mak_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '120';
                $datos['ta_Y'][1] = '95';
                $datos['ta_X'][2] = '550';
                $datos['ta_Y'][2] = '415';
                // Adjuntos
                $datos['ruta_adjunto'] = '/makinaria/';
                break;
            case 'makinaNueva':
                // Imagenes
                $datos['ruta'] = 'makinariaNueva/';
                $datos['varible'] = 'id_maquinaNueva';
                $datos['pre'] = 'makNu_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '120';
                $datos['ta_Y'][1] = '95';
                $datos['ta_X'][2] = '800';
                $datos['ta_Y'][2] = '600';
                // Adjuntos
                $datos['ruta_adjunto'] = '/makinariaNueva/';
                break;

            case 'mailing':
                // Imagenes
                $datos['ruta'] = 'carta/';
                $datos['varible'] = 'id_mailing';
                $datos['pre'] = 'mail_';
                $datos['cuantos'] = '2';
                //Tamaños
                $datos['ta_X'][1] = '230';
                $datos['ta_Y'][1] = '230';
                $datos['ta_X'][2] = '500';
                $datos['ta_Y'][2] = '500';
                // Adjuntos
                $datos['ruta_adjunto'] = '/carta/';
                break;

            case 'gastos':
                // Imagenes
                $datos['ruta'] = 'gastos/';
                $datos['varible'] = 'id_gasto';
                $datos['pre'] = 'gas_';
                $datos['cuantos'] = '1';
                //Tamaños
                $datos['ta_X'][1] = '350';
                $datos['ta_Y'][1] = '350';
                // Adjuntos
                $datos['ruta_adjunto'] = '/gastos/';
                break;
            case 'clientes':
                // Imagenes
                $datos['ruta'] = 'clientes/';
                $datos['varible'] = 'id_cliente';
                $datos['pre'] = 'cli_';
                $datos['cuantos'] = '1';
                //Tamaños
                $datos['ta_X'][1] = '350';
                $datos['ta_Y'][1] = '350';
                // Adjuntos
                $datos['ruta_adjunto'] = '/clientes/';
                break;
            case 'expedientes':
                // Imagenes
                $datos['ruta'] = 'expedientes/';
                $datos['varible'] = 'id_expediente';
                $datos['pre'] = 'exp_';
                $datos['cuantos'] = '1';
                //Tamaños
                $datos['ta_X'][1] = '550';
                $datos['ta_Y'][1] = '550';
                // Adjuntos
                $datos['ruta_adjunto'] = '/expedientes/';
                break;
        }
        return $datos;
    }
}
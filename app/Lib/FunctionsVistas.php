<?php
/**
 * Created by PhpStorm.
 * User: IRUNWEBSERVER
 * Date: 11/10/2017
 * Time: 10:36.
 */

namespace App\Lib;

use  App\Http\Controllers\ImageController;

class FunctionsVistas
{
    public static $cssOcultar = 'ocultar';
    public static $claseOcultar = false;

    public static function publicar($value, $titulo = false)
    {
        if ($value == '1') {
            return "<i class=\"fa fa-check\" aria-hidden=\"true\" title='".$titulo."'></i>";
        } else {
            return "<i class=\"fa fa-times\" aria-hidden=\"true\" title='".$titulo."'></i>";
        }
    }

    public static function tipoExpediente($tipo)
    {
        $datoAcronimo = "<abbr lang='es' title='Recambios nuestras marcas'>REC-NM</abbr>";
        if ($tipo == '1') {
            $datoAcronimo = "<abbr  lang='es' title='Recambios nuestras marcas'>REC-NM</abbr>";
        }
        if ($tipo == '2') {
            $datoAcronimo = "<abbr lang='es' title='Maquinaria'>M</abbr>";
        }
        if ($tipo == '3') {
            $datoAcronimo = "<abbr lang='es' title='Reparaciones'>R</abbr>";
        }
        if ($tipo == '4') {
            $datoAcronimo = "<abbr lang='es' title='Varios'>VA</abbr>";
        }
        if ($tipo == '5') {
            $datoAcronimo = "<abbr lang='es' title='Garantias'>GA</abbr>";
        }
        if ($tipo == '6') {
            $datoAcronimo = "<abbr lang='es' title='Accesorios'>AC</abbr>";
        }
        if ($tipo == '7') {
            $datoAcronimo = "<abbr lang='es' title='Recambios otras marcas'>REC-OM</abbr> ";
        }
        if ($tipo == '8') {
            $datoAcronimo = "<abbr lang='es' title='Consumibles'>CONS</abbr>";
        }

        return $datoAcronimo;
    }

    public static function setTextarea($nombreCampo, $nombreId, $valorNombre, $valorId, $nombreTabla, $permiso, $attr = false)
    {
        $attrFormateado = self::setAtributos($attr, $valorNombre);
        $clasePermiso = self::setPermiso($permiso);

        $cadena = "<span class='".$clasePermiso.'  '.$attrFormateado['claseOcultarSpan']." ' data-nomDiv = '".$nombreCampo.$valorId."' id = '".$nombreCampo.$valorId."_t' >".$valorNombre."</span>
                        <textarea name='".$nombreCampo.$valorId."' id ='".$nombreCampo.$valorId."'
                            class='".$attrFormateado['claseInput']." mostraOcultarInput guardarEnBDInput form-control input-sm' rows='5'
                            data-nomDiv = '".$nombreCampo.$valorId."_t'
                            data-nombreTabla = '".$nombreTabla."'
                            data-nombreId ='".$nombreId."' data-nombreCampo = '".$nombreCampo."'
                            data-valorId='".$valorId."'
                            placeholder='".$attrFormateado['placeholder']."'>".$valorNombre.'</textarea>';
        return $cadena;
    }

    public static function setIput($nombreCampo, $nombreId, $valorNombre, $valorId, $nombreTabla, $permiso, $attr = false)
    {
    	$attrFormateado = self::setAtributos($attr, $valorNombre);
    	$clasePermiso = self::setPermiso($permiso);
    	$cadena = "<span class='" . $clasePermiso . ' ' . $attrFormateado['claseOcultarSpan'] . "' data-nomDiv = '" . $nombreCampo . $valorId . "' id = '" . $nombreCampo . $valorId . "_t' >" . $valorNombre . "</span>
            <input name = '" . $nombreCampo . $valorId . "' type = 'text' id = '" . $nombreCampo . $valorId . "'
                   class='" . $attrFormateado['claseInput'] . " " . $attrFormateado['class'] . " mostraOcultarInput guardarEnBDInput form-control input-sm '
            data-nomDiv = '" . $nombreCampo . $valorId . "_t'  value = '" . $valorNombre . "'
            data-nombreTabla = '" . $nombreTabla . "'
            data-nombreId = '" . $nombreId . "' data-nombreCampo = '" . $nombreCampo . "'
            data-valorId = '" . $valorId . "'
            placeholder='" . $attrFormateado['placeholder'] . "'/>";

    return $cadena;
    }

    private static function setPermiso($permiso)
    {
        $clasePermiso = 'mostraOcultarInput';
        if ($permiso) {
            $clasePermiso = 'mostraOcultarInput';
        } else {
            $clasePermiso = '';
        }
        return $clasePermiso;
    }

    private static function setAtributos($attr, $valorNombre)
    {
        $attrFormateado['claseInput']   = self::$cssOcultar; // ocultar
        $attrFormateado['claseOcultarSpan'] = self::$claseOcultar; //false
        $attrFormateado['placeholder']  = '';
        $attrFormateado['class']= false;
      /* echo "<pre>";
        var_dump($attr);
        echo "</pre>";/*/

        if(is_array($attr)) {
            if(array_key_exists('placeholder', $attr)){
                $attrFormateado['placeholder'] = $attr['placeholder'];
            }
            if(array_key_exists('verInputSiVacio', $attr)){
                if($attr['verInputSiVacio']){
                     if ($valorNombre=='') {
                        $attrFormateado['claseInput']='';
                    }
                }
            }
            if(array_key_exists('ocultarSpan', $attr)){
                if($attr['ocultarSpan']){
                    $attrFormateado['claseOcultarSpan']=' ocultar';
                }
            }
            if(array_key_exists('mostrarInput', $attr)){
                if($attr['mostrarInput']){
                    $attrFormateado['claseOcultarSpan']=' ocultar';
                    $attrFormateado['claseInput']='';
                }
            }
            if(array_key_exists('class', $attr)){
                if($attr['class']){
                    $attrFormateado['class']= $attr['class'];

                }
            }
        }
        return $attrFormateado;
    }

    public static function dameThumbnail($datos)
    {
        $cargo = '';
        if ($datos->cargo != '') {
            $cargo = '( '.FunctionsBd::dameDatoExacto('contactos_cargo', 'id_cc', '=', $datos->cargo, 'nom_cc_1').' )';
        }
        $imagenes = new ImageController();
        $imagenes = $imagenes->dameImagenes('cont_', $datos->id_contactos, '1');
        $imagen = "<img src='/images/cont/xx.gif'>";
          /* echo "<pre>";
           var_dump($imagenes);
            echo "</pre>";*/
        if ($imagenes) {
            foreach ($imagenes as $imagen) {
                $imagen = '<img src="/images/cont/'.$imagen->nom_imagenes.'" alt="'.$imagen->title_imagenes.'">';
                //echo $imagen->nom_imagenes."<br>";
            }
        }
        $cadena = "<div class='col-md-2 col-xs-3'>
            <div class='thumbnail' style='height:210px;'>
                 ".$imagen."
                <div class='caption'>
                    <p><strong>".$datos->nom_contactos.'</strong><br>'.$datos->apellido_1_contactos.' '.$datos->apellido_2_contactos.'<br>
                    '.$cargo.' </p>
                </div>
            </div>
        </div>';

        return $cadena;
    }
}

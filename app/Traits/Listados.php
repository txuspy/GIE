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
    
    public static function limpiarAtributosHtml($html){
        
        $search = array('&nbsp;', '<br>;');
        $output = str_replace($search, "", trim($html));
        $output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
        $output = strip_tags($output, '<p><h1><h2><h3><h4><h5><h6><strong><em><sup><sub><table><tr><td><ul><li><ol>');
        $output = self::closetags($output);
        //$output = \App\Traits\Listados::closetags($output);
        return $output;
    }

    public static function closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    } 

    public static function fechasIndex($objeto)
    {
        /*if( \Session::get('locale') == 'es' ){
		    echo $objeto->updated_at->format('d-m-Y')." (Ins. ".$objeto->created_at->format('d-m-Y').")";
	    }else{
		    echo $objeto->updated_at->format('Y-m-d')." (Sortu. ".$objeto->created_at->format('Y-m-d').")";
        }*/
        echo $objeto->updated_at->format('Y-m-d')." ( ".__('Sortu').".  ".$objeto->created_at->format('Y-m-d').")";
    }
    
    public static function cambiarURLIdioma($lng )
    {
        return str_replace("/".\Request::segment(1)."/", "/".$lng."/", \URL::full() );
    }

    public static function listadoEkarpena()
    {

        $miArray =
        [
        '0' => __('Aukeratu'),
        '1' => __('Hitzaldi gonbidatua'),
        '2' => __('Ahozko aurkezpena'),
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

<?php

namespace App\Http\Controllers;
use Codedge\Fpdf\Fpdf\Fpdf;

class Fpdfcustom extends FPDF {
    function pintarAcentos($texto){

			//si quisiera poner mayuscula
			//$texto = strtoupper($texto);
			$texto = str_replace("&aacute;", "á",$texto);
			$texto = str_replace("&eacute;","é", $texto);
			$texto = str_replace("&iacute;","í", $texto);
			$texto = str_replace("&oacute;","ó", $texto);
			$texto = str_replace("&uacute;","ú", $texto);
			$texto = str_replace("&Aacute;","Á", $texto);
			$texto = str_replace("&Eacute;","É", $texto);
			$texto = str_replace("&Iacute;","Í", $texto);
			$texto = str_replace("&Oacute;","Ó", $texto);
			$texto = str_replace("&Uacute;","Ú", $texto);
			$texto = str_replace("&ntilde;","ñ", $texto);
			$texto = str_replace("&Ntilde;","Ñ", $texto);
			$texto = str_replace("&ordm;","º", $texto);
			$texto = str_replace("&iquest;","¿", $texto);
			$texto = str_replace("&agrave;","à", $texto);
			$texto = str_replace("&egrave;","è", $texto);
			$texto = str_replace("&igrave;","ì", $texto);
			$texto = str_replace("&ograve;","ò", $texto);
			$texto = str_replace("&ugrave;","ù", $texto);
			$texto = str_replace("&Agrave;","À", $texto);
			$texto = str_replace("&Egrave;","È", $texto);
			$texto = str_replace("&Igrave;","Ì", $texto);
			$texto = str_replace("&Ograve;","Ò", $texto);
			$texto = str_replace("&Ugrave;","Ù", $texto);
			$texto = str_replace("&acirc;","â", $texto);
			$texto = str_replace("&ecirc;","ê", $texto);
			$texto = str_replace("&icirc;","î", $texto);
			$texto = str_replace("&ocirc;","ô", $texto);
			$texto = str_replace("&ucirc;","û", $texto);
			$texto = str_replace("&Acirc;","Â", $texto);
			$texto = str_replace("&Ecirc;","Ê", $texto);
			$texto = str_replace("&Icirc;","Î", $texto);
			$texto = str_replace("&Ocirc;","Ô", $texto);
			$texto = str_replace("&Ucirc;","Û", $texto);
			$texto = str_replace("&auml;","ä", $texto);
			$texto = str_replace("&euml;","ë", $texto);
			$texto = str_replace("&iuml;","ï", $texto);
			$texto = str_replace("&ouml;","ö", $texto);
			$texto = str_replace("&uuml;","ü", $texto);
			$texto = str_replace("&Auml;","Ä", $texto);
			$texto = str_replace("&Euml;","Ë", $texto);
			$texto = str_replace("&Iuml;","Ï", $texto);
			$texto = str_replace("&Ouml;","Ö", $texto);
			$texto = str_replace("&Uuml;","Ü", $texto);
			$texto = str_replace("&ccedil;", "ç", $texto);
			$texto = str_replace("&Ccedil;","Ç", $texto);
			$texto = str_replace("&acute;","'", $texto);
			$texto = str_replace("&acute;","`", $texto);

			return $texto;
		}
    function PintarDatosCliente($cliente, $x, $y, $orden )
		{
			$r1  = $this->w - $x;
			$y1  = $this->h - $y ;
			$this->SetFont( "Arial", "B", 10);
			$this->SetXY( $r1, $y1+2 );
		    /*$this->SetLeftMargin(0.35);
			$this->SetRightMargin(0.35);
			$this->SetTopMargin(0.35);*/
			if ( strlen($cliente->nom_cliente) > 25){
				$this->MultiCell(85,4, $this->pintarAcentos($cliente->nom_cliente));
				$a=4;
			}  else {
				$this->Cell(90,4,$this->pintarAcentos($cliente->nom_cliente), 0, 0, "L");
				$a=0;
			}
			$this->SetFont( "Arial", "", 10);
			$this->SetXY( $r1, $a+$y1+6);
			if($cliente->direcciones){
			    foreach ($cliente->direcciones as $direccion){
    			    if($direccion->tipo_direccion=='1'){
    			        if ( strlen($cliente->direccion_direccion) > 25){
    				$this->MultiCell(80,4,$this->pintarAcentos($direccion->direccion_direccion));
    				$j=4;
        			} else{
        				$this->Cell(90,4,$this->pintarAcentos($direccion->direccion_direccion), 0, 0, "L");
        				$j=0;
        			}
        			$this->SetXY( $r1, $a+$y1+$j+10 );
        			$this->Cell(90,4, "CP.: ".$direccion->cp_direccion.", ".$direccion->poblacion_direccion , 0, 0, "L");
        			$this->SetXY( $r1, $a+$y1+$j+14 );
        			$this->Cell(90, 5,  $direccion->provincia_direccion.", ".$direccion->pais_direccion ,0, 0, 'L', 0);
        			$this->SetXY( $r1, $a+$y1+$j+18 );
        			$this->SetFont( "Arial", "I", 7);
        			$this->Cell(90, 5,  $orden,0, 0, 'R', 0);
    			    }
			    }
			}

		}
    function Contenido($cliente, $x , $y, $marketingUrl){
		$orden = false;
		$this->PintarDatosCliente($cliente,  $x , $y,  $orden );
	}
}
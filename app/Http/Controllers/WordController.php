<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoInvestigacion;
use App\GrupoInvestigacionParticipantes;
use App\GrupoInvestigacionResponsables;
use App\TesisDoctorales;
use App\TesisDoctoralesDirectores;
use App\TesisDoctoralesDoctorando;
use App\Formaciones;
use App\FormacionesAutores;
use App\Proyectos;
use App\ProyectosInvestigadores;
use App\ProyectosDirectores;
use App\Congresos;
use App\CongresosProfesores;
use App\Postgrados;
use App\PostgradosAutores;
use App\Visitas;
use App\VisitasAutores;
use App\Autor;
use App\Publicaciones;
use App\PublicacionesAutores;
use App\ProgramasDeIntercambio;
use App\ProgramasDeIntercambioProfesores;
use App\EquipamientoNuevo;
use Carbon\Carbon;
use App\Lib\Functions;
// use HTMLtoOpenXML;

class WordController extends Controller
{
    private $year ;
    private $fechaDesde ;
    private $fechaHasta ;
    private $tableStyle ;
    private $styleFirstTHRow ;
    private $styleFirstTDRow ;
    private $styleLastTHRow ;
    private $styleLastTDRow ;
    private $styleTH ;
    private $styleTD ;
    private $widthTH ;
    private $widthTD ;
    private $styleH1 ;
    private $fuente;
    private $unico = false;


    public function index()
    {
       return view('word.index') ;
    }



    public function create(Request $request)
    {

        $this->validate($request, [
            'desde'     => 'required',
            'hasta'     => 'required',
            'secciones' => 'required'
        ]);

        /*
        $this->formatearYear($request['year'], $request['mes']);
        */

        if(\Auth::user()->hasRole('owner') OR \Auth::user()->hasRole('admin') ){
            if (in_array("unico", $request['usuarios'])) {
                $this->userId = \Auth::user()->id;
                $this->unico  = true;
            }
        }else{
            $this->userId = \Auth::user()->id;
            $this->unico  = true;
        }
        \LaravelGettext::setLocale($request->lng);
        $this->fechaDesde = $request['desde'];
        $this->fechaHasta = $request['hasta'];

        $this->setStyles();
        if( \Session::get('locale') =='es'){
            $this->fuente = "EHU-Sans";
        }else{
            $this->fuente = "EHU-Serif";
        }

        // Word sortu
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName($this->fuente);


        $phpWord->setDefaultParagraphStyle(
            array(
                'spaceAfter'  => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
                'spacing'     => 120,
                'lineHeight'  => 1.2,
            )
        );


        $section = $this->indiceWord($phpWord, $request['secciones'] );

	    if (in_array("2", $request['secciones'])) {
            $this->wordPostgrados( $section, 'master', $phpWord );
            $this->wordPostgrados( $section, 'doctorando', $phpWord );
	    }

	    if (in_array("3", $request['secciones'])) {
            $this->Formaciones( $section,  'PDI', 'recibir', $phpWord);
            $this->Formaciones( $section,  'PDI', 'dar', $phpWord);
            $this->Formaciones( $section,  'PAS', 'recibir', $phpWord);
            $this->Formaciones( $section,  'PAS', 'dar', $phpWord);
	    }
	    if (in_array("4", $request['secciones'])) {
            //$this->wordProgramaDeIntercambio( $section, 'azp', $phpWord);
	    }
	    if (in_array("4", $request['secciones'])) {
            $this->wordProgramaDeIntercambio( $section, 'fuera', $phpWord);
            $this->wordProgramaDeIntercambio( $section, 'enCasa', $phpWord);
		}
	    if (in_array("5", $request['secciones'])) {
            $this->wordVisitas( $section,  $phpWord);
	    }
	    if (in_array("6", $request['secciones'])) {
            $this->wordGrupoInvestigacion( $section, $phpWord);
	    }
	    if (in_array("7", $request['secciones'])) {
            $this->wordTesis( $section, 'tesisLeidas', $phpWord);
	    }
	    if (in_array("9", $request['secciones'])) {
            $this->wordEquipoNuevo( $section, $phpWord);
		}
	    if (in_array("10", $request['secciones'])) {
            $this->wordProyectos( $section,  'europa',  $phpWord);
            $this->wordProyectos( $section,  'erakundeak',  $phpWord);
            $this->wordProyectos( $section,  'empresa',  $phpWord);
	    }
	    if (in_array("11", $request['secciones'])) {
            $this->wordCongreso( $section, $phpWord);
	    }
	    if (in_array("12", $request['secciones'])) {
    		$this->wordPublicacion( $section, 'libros', $phpWord);
    		$this->wordPublicacion( $section, 'articulos', $phpWord);
	    }


        // Doc itxi
        $docName = Carbon::now()."-GIE.docx";
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($docName);
        header('Pragma: no-cache');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename='.$docName.';');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize( $docName ));
        readfile($docName );
        unlink($docName );
        \LaravelGettext::setLocale(Session::get('locale'));
        return back()->with('success', __('Word zuzen sortu da'));
    }


    public function indiceWord($phpWord, $secciones)
    {
        $section = $phpWord->addSection();
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        /*$fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(16);*/
        $section->addText(__('Gipuzkoako Ingeniaritza Eskola'), array('name' => $this->fuente, 'size' => 20, 'bold' => true) );
        $section->addText("( ".$this->fechaDesde." / ".$this->fechaHasta." )", array('name' => $this->fuente, 'size' => 12, 'bold' => false) );
        $section->addText(" ", array('name' => $this->fuente, 'size' => 12, 'bold' => false) );
       // $myTextElement->setFontStyle($fontStyle);
        $phpWord->addNumberingStyle(
            'multilevel',
            array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                )
            )
        );
        /*
        if (in_array("2", $secciones)) {echo "Postgrados<br>";  }
        if (in_array("3", $secciones)) {echo "Formaciones<br>";  }
        if (in_array("4", $secciones)) {echo "Programas de intercambio<br>";
        if (in_array("5", $secciones)) {echo "Visitas<br>";  }
        if (in_array("6", $secciones)) {echo "Grupo de investigacion<br>";  }
        if (in_array("7", $secciones)) {echo "Tesis<br>";  }
        if (in_array("8", $secciones)) {echo "Grupo de investigacion<br>";  }
        if (in_array("9", $secciones)) {echo "Equipamiento Nuevo<br>";  }
        if (in_array("10", $secciones)) {echo "Proyectos<br>";  }
        if (in_array("11", $secciones)) {echo "Congresos<br>";  }
        if (in_array("12", $secciones)) {echo "Publicaciones<br>";  }
        */
        ;
        if ( in_array("2", $secciones) OR in_array("3", $secciones) OR in_array("4", $secciones) OR in_array("5", $secciones)) {
            $section->addText( __('ACTIadfaVIDAD DOCENTE'), array('name' => $this->fuente, 'size' => 13, 'bold' => true) );
        }
        if (in_array("2", $secciones)) {
            $section->addListItem( __('Graduondoko programak'), 0, null, 'multilevel');
            $section->addListItem( __('Masterretan parte-hartzea'), 1, null, 'multilevel');
            $section->addListItem( __('Doktoretzan parte-hartzea'), 1, null, 'multilevel');
        }
        if (in_array("3", $secciones)) {
            $section->addListItem( __('IIPko Formazioa Jarduerak'), 0, null, 'multilevel');
            $section->addListItem( __('Jasotako formakuntza'), 1, null, 'multilevel');
            $section->addListItem( __('Emandako formazioa'), 1, null, 'multilevel');

            $section->addListItem( __('AZPko Formazioa Jarduerak'), 0, null, 'multilevel');
            $section->addListItem( __('Jasotako formakuntza'), 1, null, 'multilevel');
            $section->addListItem( __('Emandako formazioa'), 1, null, 'multilevel');

        }
        if (in_array("4", $secciones)) {
            //$section->addListItem( __('Elkartrukeko programak'), 0, null, 'multilevel');
            //$section->addListItem( __('IIP /AZP mugikortasuna'), 1, null, 'multilevel');
            $section->addListItem( __('Elkartrukeko programak'), 0, null, 'multilevel');
            $section->addListItem( __('Egonaldi zientifikoak beste unibertsitateetan'), 1, null, 'multilevel');
            $section->addListItem( __('Etorritako ikerlariak'), 1, null, 'multilevel');
        }
        if (in_array("5", $secciones)) {
            $section->addListItem( __('Instalazio bisitak'), 0, null, 'multilevel');
        }
        if ( in_array("6", $secciones) OR in_array("7", $secciones) OR in_array("9", $secciones) OR in_array("10", $secciones) OR in_array("11", $secciones) OR in_array("12", $secciones)) {
            $section->addText( __('ACTIVIDAdfadfD INVESTIGADORA'), array('name' => $this->fuente, 'size' => 13, 'bold' => true));
        }
        if (in_array("6", $secciones)) {
            $section->addListItem( __('Ikerkuntza taldea'), 0, null, 'multilevel');
        }
        if (in_array("7", $secciones)) {
            $section->addListItem( __('Tesiak') , 0, null, 'multilevel');
            /*$section->addListItem( __('Uneko Tesiak'), 1, null, 'multilevel');
            $section->addListItem( __('Burutu diren Tesiak'), 1, null, 'multilevel');*/
        }
        if (in_array("9", $secciones)) {
            $section->addListItem( __('Hornikuntza Zientifikoa eskuratzea'), 0, null, 'multilevel');
        }
        if (in_array("10", $secciones)) {
            $section->addListItem( __('Ikerkuntza Proiektuak'), 0, null, 'multilevel');
            $section->addListItem( __('Europar Batasuneko Programa Markoa'), 1, null, 'multilevel');
            $section->addListItem( __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
            $section->addListItem( __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
        }
        if (in_array("11", $secciones)) {
            $section->addListItem( __('Kongresu Zientifikoetan parte-hartzea'), 0, null, 'multilevel');
        }
        if (in_array("12", $secciones)) {
            $section->addListItem( __('Argitalpenak'), 0, null, 'multilevel');
            $section->addListItem( __('Liburuak eta Monografiak'), 1, null, 'multilevel');
            $section->addListItem( __('Artikuloak'), 0, null, 'multilevel');
        }
        $section->addPageBreak();
        return $section;
    }

    public function wordPostgrados( $section, $tipo, $phpWord)
    {

        if(  $this->unico  ){
            $postgrados = Postgrados::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
                ->where('tipo',$tipo)
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);
                    $query->orWhereIN('id', PostgradosAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_postgrado'));
                })
                ->orderBy('fecha','DESC')
                ->get();
        }else{
            $postgrados = Postgrados::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
                ->where('tipo', $tipo)
                ->orderBy('fecha','DESC')
                ->get();
        }

        if(count($postgrados)){
            if( $tipo == 'master' ){
                $tituloH1 = __('Masterretan parte-hartzea') ;
            }else{
                $tituloH1 = __('Doktoretza-programetan parte-hartzea');
            }
            $lang      = \Session::get('locale');
            $tableName = $tituloH1;

            $section->addText( __('Graduondoko Programa - ').$tituloH1 , $this->styleH1  );
            $phpWord->addTableStyle($tableName, $this->tableStyle);

            $table     = $section->addTable($tableName);
            $titulo    = "titulo_".$lang;
            $curso     = "curso_".$lang;


            foreach ($postgrados as $postgrado){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Programa'), $postgrado->$titulo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Saila'), \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$postgrado->departamento]??'---' );
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kurtsoa'), $postgrado->$curso);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Irakaslea(k)'), $this->listadoAutores($postgrado->autores));
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $postgrado->lugar);
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Iraupena'), $postgrado->duracion);
            }
            $section->addPageBreak();
        }
    }

    public function Formaciones( $section, $tipo, $modo, $phpWord)
    {
        if(  $this->unico  ){
            $formaciones = Formaciones::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
            ->where('tipo', $tipo)
            ->where('modo', $modo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', FormacionesAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_formacion'));
            })
            ->orderBy('fecha','DESC')
            ->get();
        }else{
            $formaciones = Formaciones::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
            ->where('tipo', $tipo)
            ->where('modo', $modo)
            ->orderBy('fecha','DESC')
            ->get();
        }
        if(count($formaciones)){
            if( $tipo == 'PAS' ){
                $tituloH1 = __('AZKko formazioa ') ;
            }else{
                $tituloH1 = __('IIPko formazioa ');
            }
            if( $modo == 'recibir' ){
                $tituloH2 = __('Hartutakoa') ;
                $titAutor = __('Parte-hartzailea(k)');
            }else{
                $tituloH2 = __('Emandakoa');
                $titAutor = __('Hizlaria(k)');
            }
            $lang      = \Session::get('locale');
            $tableName = $tituloH1;

            $section->addText( $tituloH1. " - ".$tituloH2 , $this->styleH1  );
            $phpWord->addTableStyle($tableName, $this->tableStyle);

            $table          = $section->addTable($tableName);
            $titulo         = "titulo_".$lang;
            $organizador    = "organizador_".$lang;


            foreach ($formaciones as $formacion){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Kurtsoa'), $formacion->$titulo);
                if( $modo == 'recibir' ){
                    $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Antolatzailea(k)'), $formacion->$organizador);
                }
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $formacion->lugar);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Iraupena'), $formacion->duracion);
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, $titAutor , $this->listadoAutores($formacion->autores));
            }
            $section->addPageBreak();
        }
    }


    public function wordProgramaDeIntercambio( $section, $tipo, $phpWord)
    {
        if(  $this->unico  ){
             $programasDeIntercambios = ProgramasDeIntercambio::where('tipo', $tipo)
                ->where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
              ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', ProgramasDeIntercambioProfesores::where('id_autor', \Auth::user()->id_autor)->pluck('id_programaIntercambio'));
            })
            ->orderBy('id','DESC')->get();

        }else{
            $programasDeIntercambios = ProgramasDeIntercambio::where('tipo', $tipo)
                ->where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
            ->orderBy('id','DESC')->get();
        }
        if(count($programasDeIntercambios)){
            if( $tipo == 'azp' ){
                $tituloH1 = __('IIP / AZPren mugikortasuna') ;
                $autores =  __('IIP / AZP');
            }elseif( $tipo == 'fuera' ){
                $tituloH1 = __('Egonaldi zientifikoak beste Unibertsitateetan');
                $autores =  __('Ikerlaria(k)');
            }else{
                //enCasa
                $tituloH1 = __('Etorritako ikerlariak');
                $autores =  __('Ikerlaria(k)');
            }

            $lang = \Session::get('locale');
            $section->addText( $tituloH1 , $this->styleH1  );
            $tableName     = $tituloH1;
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table           = $section->addTable($tableName);

            $actividad = "actividad_".$lang;

            foreach ($programasDeIntercambios as $programaDeIntercambio){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Aktibitatea'), $programaDeIntercambio->$actividad);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $programaDeIntercambio->lugar);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $autores , $this->listadoAutores($programaDeIntercambio->profesores));
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data(k)'), $programaDeIntercambio->desde." - ".$programaDeIntercambio->hasta);
            }
            $section->addPageBreak();
        }
    }




    public function wordVisitas( $section,  $phpWord)
    {
        if(  $this->unico  ){
            $visitas = Visitas::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);
                    $query->orWhereIN('id', VisitasAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_visita'));
                })
                ->orderBy('fecha','DESC')
                ->get();
        }else{
            $visitas = Visitas::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
                ->orderBy('fecha','DESC')
                ->get();
        }
        if(count($visitas)){
            $tituloH1 = __('Bisitak') ;

            $lang      = \Session::get('locale');
            $tableName = $tituloH1;

            $section->addText( $tituloH1 , $this->styleH1  );
            $phpWord->addTableStyle($tableName, $this->tableStyle);

            $table     = $section->addTable($tableName);
            $titulo    = "titulo_".$lang;

            foreach ($visitas as $postgrado){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Aktibitatea'), $postgrado->$titulo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $postgrado->lugar);
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Irakaslea(k)'), $this->listadoAutores($postgrado->autores));
            }
            $section->addPageBreak();
        }
    }

    public function wordGrupoInvestigacion( $section, $phpWord)
    {

        $fechaDesde = Carbon::parse($this->fechaDesde);
        $fechaHasta = Carbon::parse($this->fechaHasta);
        if(  $this->unico  ){
            $gruposInvestigacion = GrupoInvestigacion::where('desde', '<=',  $fechaDesde->format('Y'))
                ->where('hasta','>=',  $fechaHasta->format('Y'))
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);
                    $query->orWhereIN('id', GrupoInvestigacionParticipantes::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
                    $query->orWhereIN('id', GrupoInvestigacionResponsables::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
                })
                ->orderBy('id','DESC')->get();
        }else{
            $gruposInvestigacion = GrupoInvestigacion::where('desde', '<=',  $fechaDesde->format('Y'))
            ->where('hasta','>=',  $fechaHasta->format('Y'))
            ->orderBy('id','DESC')->get();
        }
        if(count($gruposInvestigacion)){
            $lang = \Session::get('locale');
            $section->addText( __('Ikerkuntza taldea') , $this->styleH1 );
            $tableName     = __('Ikerkuntza taldea');
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table           = $section->addTable($tableName);

            // Tabla contenido variable
            $grupo = "grupo_".$lang;
            $lineaInv = "lineasInv_".$lang;




            foreach ($gruposInvestigacion as $grupoInvestigacion){
               // $parser = new HTMLtoOpenXML\Parser();
               // $ooXml = $parser->fromHTML($grupoInvestigacion->$lineaInv);
               // $ooXml = "<w:p><w:r><w:rPr><w:strike/></w:rPr><w:t>some texte</w:t></w:r></w:p>";
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Taldea'), $grupoInvestigacion->$grupo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $grupoInvestigacion->lugar);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Arduraduna(k)'), $this->listadoAutores($grupoInvestigacion->responsables));
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kidea(k)'), $this->listadoAutores($grupoInvestigacion->participantes ));
                //$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), $ooXml );
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), $grupoInvestigacion->$lineaInv );
            }
            $section->addPageBreak();
        }
    }


	public function wordTesis( $section, $tipo,  $phpWord)
    {
        //Esta montado porsi con tipo pq hay dos leidas por leer pero ahora voy a poner siempre leida
        if(  $this->unico  ){
            $tesisLeidas = TesisDoctorales::where('tipo','tesisLeidas')
                ->whereBetween('fechaLectura', [ $this->fechaDesde,  $this->fechaHasta ])
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);
                    $query->orWhereIN('id', TesisDoctoralesDirectores::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
                    $query->orWhereIN('id', TesisDoctoralesDoctorando::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
                })
                ->orderBy('id','DESC')->get();
        }else{
            $tesisLeidas = TesisDoctorales::where('tipo','tesisLeidas')
            ->whereBetween('fechaLectura', [ $this->fechaDesde,  $this->fechaHasta ])
            ->orderBy('id','DESC')->get();
        }
        if(count($tesisLeidas)){
            if( $tipo == 'tesisLeidas' ){
                $tituloH1 = __('Tesiak') ;
            }else{
                $tituloH1 = __('Tesiak');
            }
            $lang      = \Session::get('locale');
            $tableName = $tituloH1;

            $section->addText( $tituloH1 , $this->styleH1  );
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table     = $section->addTable($tableName);
            // Tabla contenido variable
            $titulo = "titulo_".$lang;

            foreach ($tesisLeidas as $tesis){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Izenbururua'), $tesis->$titulo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Zuzendaria(k)'), $this->listadoAutores($tesis->directores));
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Doktorando(k)'), $this->listadoAutores($tesis->doctorandos ));
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Saila'), \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$tesis->departamento]??'---' );

            }
            $section->addPageBreak();
        }
    }

    public function wordProyectos( $section, $tipo, $phpWord)
    {
        if(  $this->unico  ){
            $proyectos = Proyectos::where('tipo',$tipo)
             ->where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
              ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', ProyectosInvestigadores::where('id_autor', \Auth::user()->id_autor)->pluck('id_proyecto'));
                $query->orWhereIN('id', ProyectosDirectores::where('id_autor', \Auth::user()->id_autor)->pluck('id_proyecto'));
            })
            ->orderBy('id','DESC')->get();
        }else{
            $proyectos = Proyectos::where('tipo',$tipo)
             ->where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
            ->orderBy('id','DESC')->get();
        }
        if(count($proyectos)){
            if( $tipo == 'europa' ){
                $tituloH1 = __('Europar Batasuneko Programa Markoa') ;
            }elseif( $tipo == 'erakundeak' ){
                $tituloH1 = __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak');
            }else{
                //empresa
                $tituloH1 = __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak');
            }

            $lang = \Session::get('locale');
            $section->addText( $tituloH1 , $this->styleH1  );
            $tableName     = $tituloH1;
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table           = $section->addTable($tableName);

            $actividad = "proyecto_".$lang;

            foreach ($proyectos as $proyecto){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Proiektua'), $proyecto->$actividad);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Finantziazioa'), $proyecto->financinacion);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Ikertzaile nagusia(k)') , $this->listadoAutores($proyecto->directores));
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Partaidea(k)') , $this->listadoAutores($proyecto->investigadores));
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data(k)'), $proyecto->desde." - ".$proyecto->hasta);
            }
            $section->addPageBreak();
        }
    }


	 public function wordCongreso( $section, $phpWord)
    {
        if(  $this->unico  ){
            $congresos = Congresos::where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
          ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', CongresosProfesores::where('id_autor', \Auth::user()->id_autor)->pluck('id_congreso'));
            })
            ->orderBy('id','DESC')->get();

        }else{
            $congresos = Congresos::where(function ($query)  {
                  $query->where('desde', '>=', $this->fechaDesde);
                  $query->where('desde', '<=', $this->fechaHasta);
                  $query->orWhere('hasta', '>=', $this->fechaDesde);
                  $query->where('hasta', '<=', $this->fechaHasta);
              })
            ->orderBy('id','DESC')->get();
        }
        if(count($congresos)){
            //Txapuza pq gettex no saca de traits
            $tit1 = __('Aukeratu');
            $tit2 = __('Hitzaldi gonbidatua');
            $tit3 = __('Ahozko aurkezpena');
            $tit4 = __('Posterra');

            $lang = \Session::get('locale');
            $section->addText( __('Kongresu zientifikoentan parte-hartzea') , $this->styleH1  );
            // Tabla config
            $tableName     = __('Kongresu zientifikoentan parte-hartzea');
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table           = $section->addTable($tableName);

            // Tabla contenido variable
            $titCongreso = "congreso_".$lang;

            foreach ($congresos as $congreso){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Kongresu'), $congreso->$titCongreso);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Ekarpena'), \App\Traits\Listados::listadoEkarpena(\Session::get('locale'))[$congreso->ekarpena]??'---');
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'),  $congreso->lugar );
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Konferentzi/Posterra'), $congreso->conferenciaPoster);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Irakaslea(k)'), $this->listadoAutores( $congreso->profesores ));
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data'), $congreso->desde." / ".$congreso->hasta );
            }
            $section->addPageBreak();
        }
    }

	public function wordPublicacion( $section, $tipo,  $phpWord)
    {

        if(  $this->unico  ){
            $publicaciones = Publicaciones::where('tipo', $tipo)
                ->whereBetween('year', [ $this->fechaDesde,  $this->fechaHasta ])
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);
                    $query->orWhereIN('id', PublicacionesAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_publicacion'));
                })
                ->orderBy('id','DESC')->get();

        }else{
            $publicaciones = Publicaciones::where('tipo', $tipo)
                ->whereBetween('year', [ $this->fechaDesde,  $this->fechaHasta ])
                ->orderBy('id','DESC')->get();
        }
        if(count($publicaciones)){
            if( $tipo == 'libros' ){
                $tituloH1 = __('Liburuak eta Monografiak') ;
                $titArgitaletxea= __('Argitaletxea');
                $tituloISBN = "ISBN";
            }else{
                $tituloH1 = __('Artikuloak');
                $titArgitaletxea= __('Aldizkariak');
                $tituloISBN = "ISSN";
            }

            $lang      = \Session::get('locale');
            $tableName = $tituloH1;

            $section->addText( $tituloH1 , $this->styleH1  );
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table     = $section->addTable($tableName);
            // Tabla contenido variable
            $titulo = "titulo_".$lang;

            foreach ($publicaciones as $publicacion){
                $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Izenbururua'), $publicacion->$titulo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $titArgitaletxea , $publicacion->editorialRevisa);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kapituloa'), $publicacion->capitulo);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $tituloISBN , $publicacion->ISBN);
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Egilea(k)'), $this->listadoAutores($publicacion->autores));
                $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data'), $publicacion->year);

            }
            $section->addPageBreak();
        }
    }

    public function wordEquipoNuevo( $section, $phpWord)
    {
        if(  $this->unico  ){
            $equiposNuevos = EquipamientoNuevo::whereBetween('data', [ $this->fechaDesde,  $this->fechaHasta ])
                ->where(function($query) {
                    $query->where('user_id', \Auth::user()->id);

                })
                ->orderBy('id','DESC')->get();
        }else{
            $equiposNuevos = EquipamientoNuevo::where('data', '=',  $this->year)
            ->orderBy('id','DESC')->get();
        }
        if(count($equiposNuevos)){

            $lang = \Session::get('locale');
            $section->addText( __('Hornikuntza Zientifikoa eskuratzea') , array('name' => $this->fuente, 'size' => 13, 'bold' => true) );
            // Tabla config
            $tableName     = __('Hornikuntza Zientifikoa eskuratzea');
            $this->tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
            $phpWord->addTableStyle($tableName, $this->tableStyle);
            $table           = $section->addTable($tableName);
            $this->styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
            $this->styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
            $this->styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
            $this->styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
            $this->styleTH         = array( 'bgColor' => 'F1F1F1');
            $this->styleTD         = array( 'bgColor' => 'FFFFFF');
            $this->widthTH         = 3300;
            $this->widthTD         = 6550;
             // Tabla contenido variable
            $equipo = "equipo_".$lang;
            $departamento = "departamento_".$lang;

            foreach ($equiposNuevos as $equipoNuevo){

                $table->addRow();
                $table->addCell($this->widthTH , $this->styleFirstTHRow)->addText( __('Taldea') );
                $table->addCell($this->widthTD , $this->styleFirstTDRow)->addText($equipoNuevo->$departamento);
                $table->addRow();
                $table->addCell($this->widthTH , $this->styleTH)->addText(__('Arduraduna') );
                $table->addCell($this->widthTD , $this->styleTD)->addText( $equipoNuevo->$equipo );
                $table->addRow();
                $table->addCell($this->widthTH , $this->styleTH)->addText(__('Instituzioa') );
                $table->addCell($this->widthTD , $this->styleTD)->addText($equipoNuevo->institucion);
                 $table->addRow();
                $table->addCell($this->widthTH , $this->styleTH)->addText(__('Zenbateko') );
                $table->addCell($this->widthTD , $this->styleTD)->addText($equipoNuevo->importe." €" );
                $table->addRow();
                $table->addCell($this->widthTH , $this->styleLastTHRow)->addText(__('Data') );
                $table->addCell($this->widthTD , $this->styleLastTDRow)->addText($equipoNuevo->data);
            }
            $section->addPageBreak();
        }
    }

     private function formatearYear( $year , $mes){
        //$dt = Carbon::create($year, $mes, 1);
        $this->fechaDesde = Carbon::create($year, $mes, 1);
        $this->fechaHasta = Carbon::create($year, $mes, 1)->addYear();

        $this->year       = $year ;
        $this->mes        = $mes ;

       // $this->fechaDesde = $year."-09-01" ;
       // $this->fechaHasta = ($year+1)."-07-01" ;
    }

    private function listadoAutores($todoAutores){
        $autores = '';
        if(!empty($todoAutores)){
            $i = 0;
            $len = count($todoAutores);
            foreach ($todoAutores as $autor) {
                if ($i == 0) {
                    $autores.= strtolower($autor->nombre) ." ".strtolower($autor->apellido) ;
                } else if ($i == $len - 1) {
                    $autores.= ", ".strtolower($autor->nombre) ." ".strtolower($autor->apellido) ;
                }else{
                    $autores.=", ".strtolower($autor->nombre) ." ".strtolower($autor->apellido) ;
                }
                $i++;
            }
        }
        return ucwords($autores);
    }

    private function setStyles(){
        $this->tableStyle      = array('name' => $this->fuente, 'size' => 12, 'borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 20, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $this->styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $this->styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $this->styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $this->styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $this->styleTH         = array( 'bgColor' => 'F1F1F1');
        $this->styleTD         = array( 'bgColor' => 'FFFFFF');
        $this->widthTH         = 2300;
        $this->widthTD         = 7250;
        $this->styleH1         = array('name' => $this->fuente, 'size' => 13, 'bold' => true);
    }

    private function limpiarHtml($value)
    {
       $value = str_replace("<p>","",$value);
       $value = str_replace("</p>","\r\n",$value);
       $value = str_replace("<ol>","",$value);
       $value = str_replace("<li>","  ",$value);
       $value = str_replace("</li>","",$value);
       $value = str_replace("</ol>","\r\n",$value);
       $value = str_replace("<br>","\r\n",$value);
       return $value;
    }
    private function pintaLineaTabla($table, $styleTH, $styleTD, $tit, $valor)
    {
        $table->addRow();
        $table->addCell($this->widthTH , $styleTH)->addText( htmlspecialchars( $tit ) );
        $table->addCell($this->widthTD , $styleTD)->addText( htmlspecialchars( $this->limpiarHtml($valor) ) );
        return $table;
    }

}

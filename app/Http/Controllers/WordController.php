<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoInvestigacion;
use App\TesisDoctorales;
use App\Proyectos;
use App\Congresos;
use App\Publicaciones;
use App\ProgramasDeIntercambio;
use App\EquipamientoNuevo;
use Carbon\Carbon;

class WordController extends Controller
{
    private $year;
    private $fechaDesde;
    private $fechaHasta;

    private function formatearYear( $year ){
        $this->year       = $year ;
        $this->fechaDesde = $year."-09-01" ;
        $this->fechaHasta = ($year+1)."-07-01" ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('word.index') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create2(Request $request){
        $this->formatearYear($request['year']);
        $publicaciones = Publicaciones::where('tipo','libros')
            ->whereBetween('year', [ $this->fechaDesde,  $this->fechaHasta ])
            ->orderBy('id','DESC');
        $query = str_replace(array('?'), array('\'%s\''), $publicaciones->toSql());
        $query = vsprintf($query, $publicaciones->getBindings());
        dd($query);
    }

    public function create(Request $request)
    {

        $this->formatearYear($request['year']);
        // Word sortu
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $this->indiceWord($phpWord,  $phpWord);
        // Sekzio guztiak sortu
//        $this->wordGrupoInvestigacion( $section, $phpWord);
//        $this->wordTesisProximaLectura( $section, $phpWord);
       $this->wordTesisLeidas( $section, $phpWord);
//        $this->wordProyectoEuropa( $section, $phpWord);
//        $this->wordProyectoErakundeak( $section, $phpWord);
//        $this->wordProyectoEmpresak( $section, $phpWord);
//        $this->wordCongreso( $section, $phpWord);
//        $this->wordPublicacionLibros( $section, $phpWord);
//        $this->wordPublicacionArticulos( $section, $phpWord);
        $this->wordProgramaDeIntercambioFuera( $section, $phpWord);
        $this->wordProgramaDeIntercambioCasa( $section, $phpWord);
        $this->wordEquipoNuevo( $section, $phpWord);
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
        return redirect()->route('grupoInvestigacion.index')
            ->with('success', __('Word zuzen sortu da'));
    }


    public function indiceWord($phpWord)
    {
        $section = $phpWord->addSection();
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $myTextElement = $section->addText(__('Gipuzkoako Ingeniaritza Eskola') );
        $myTextElement->setFontStyle($fontStyle);
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
        $section->addListItem( __('Ikerkuntza taldea'), 0, null, 'multilevel');
        $section->addListItem( __('Tesiak'), 0, null, 'multilevel');
        $section->addListItem( __('Uneko Tesiak'), 1, null, 'multilevel');
        $section->addListItem( __('Burutu diren Tesiak'), 1, null, 'multilevel');
        $section->addListItem( __('Ikerkuntza Proiektuak'), 0, null, 'multilevel');
        $section->addListItem( __('Europar Batasuneko Programa Markoa'), 1, null, 'multilevel');
        $section->addListItem( __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
        $section->addListItem( __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
        $section->addListItem( __('Kongresu Zientifikoetan parte-hartzea'), 1, null, 'multilevel');
        $section->addListItem( __('Argitalpenak'), 1, null, 'multilevel');
        $section->addListItem( __('Liburuak eta Monografiak'), 1, null, 'multilevel');
        $section->addListItem( __('Artikuloak'), 0, null, 'multilevel');
        $section->addListItem( __('Elkartrukeko programak'), 1, null, 'multilevel');
        $section->addListItem( __('Etorritako ikerlariak'), 1, null, 'multilevel');
        $section->addListItem( __('Hornikuntza Zientifikoa eskuratzea'), 0, null, 'multilevel');

        $section->addPageBreak();
        return $section;
    }

    public function wordGrupoInvestigacion( $section, $phpWord)
    {
        $gruposInvestigacion = GrupoInvestigacion::where('desde', '<=',  $this->year)
        ->where('hasta','>=', $this->year)
        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');
        $section->addText( __('Ikerkuntza taldea') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Ikerkuntza taldea');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
         // Tabla contenido variable
        $grupo = "grupo_".$lang;
        $lineaInv = "lineasInv_".$lang;
        foreach ($gruposInvestigacion as $grupoInvestigacion){
            $arduraduna = false;
            if(!empty($grupoInvestigacion->responsables)){
                $i = 0;
                $len = count($grupoInvestigacion->responsables);
                foreach ($grupoInvestigacion->responsables as $responsable) {
                    if ($i == 0) {
                        $arduraduna.= $responsable->nombre ." ".$responsable->apellido ;
                    } else if ($i == $len - 1) {
                        $arduraduna.= ", ".$responsable->nombre ." ".$responsable->apellido ;
                    }else{
                        $arduraduna.=", ".$responsable->nombre ." ".$responsable->apellido ;
                    }
                    $i++;
                }
            }
            $kideak = false;
            if(!empty($grupoInvestigacion->participantes)){
                $i = 0;
                $len = count($grupoInvestigacion->participantes);
                foreach ($grupoInvestigacion->participantes as $participante) {
                    if ($i == 0) {
                        $kideak.= $participante->nombre ." ".$participante->apellido ;
                    } else if ($i == $len - 1) {
                        $kideak.= ", ".$participante->nombre ." ".$participante->apellido ;
                    }else{
                        $kideak.=", ".$participante->nombre ." ".$participante->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Taldea') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($grupoInvestigacion->$grupo);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Arduraduna') );
            $table->addCell($widthTD , $styleTD)->addText( $arduraduna );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Kideak') );
            $table->addCell($widthTD , $styleTD)->addText($kideak);
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Ikerketa Lerroak') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($grupoInvestigacion->$lineaInv);
        }
        $section->addPageBreak();
    }

    public function wordTesisProximaLectura( $section, $phpWord)
    {
        $tesisProximaLecturas = TesisDoctorales::where('tipo','proximaLectura')
        ->where('curso', $this->year)
        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');
        $section->addText( __('Uneko Tesiak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Uneko Tesiak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $titulo = "titulo_".$lang;
        $departamento = "departamento_".$lang;
        foreach ($tesisProximaLecturas as $tesisProximaLectura){
            $departamento = \App\Traits\Listados::listadoDepartamentos($lang)[$tesisLeida->departamento]??'---'  ;adsfd
            $doctorando = false;
            if(!empty($tesisProximaLectura->doctorandos)){
                $i = 0;
                $len = count($tesisProximaLectura->doctorandos);
                foreach ($tesisProximaLectura->doctorandos as $doctorando) {
                    if ($i == 0) {
                        $doctorando.= $doctorando->nombre ." ".$doctorando->apellido ;
                    } else if ($i == $len - 1) {
                        $doctorando.= ", ".$doctorando->nombre ." ".$doctorando->apellido ;
                    }else{
                        $doctorando.=", ".$doctorando->nombre ." ".$doctorando->apellido ;
                    }
                    $i++;
                }
            }
            $directorea = false;
            if(!empty($tesisProximaLectura->directores)){
                $i = 0;
                $len = count($tesisProximaLectura->directores);
                foreach ($tesisProximaLectura->directores as $director) {
                    if ($i == 0) {
                        $directorea.= $director->nombre ." ".$director->apellido ;
                    } else if ($i == $len - 1) {
                        $directorea.= ", ".$director->nombre ." ".$director->apellido ;
                    }else{
                        $directorea.=", ".$director->nombre ." ".$director->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenbururua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($tesisProximaLectura->$titulo);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zuzendaria') );
            $table->addCell($widthTD , $styleTD)->addText( $directorea );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Doktorando') );
            $table->addCell($widthTD , $styleTD)->addText( $doctorando );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Saila') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($tesisProximaLectura->$departamento);
        }
        $section->addPageBreak();
    }

    public function wordTesisLeidas( $section, $phpWord)
    {
        $tesisLeidas = TesisDoctorales::where('tipo','tesisLeidas')
        ->whereBetween('fechaLectura', [ $this->fechaDesde,  $this->fechaHasta ])
        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');
        $section->addText( __('Burutu diren Tesiak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Burutu diren Tesiak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $titulo = "titulo_".$lang;
        $departamento = "departamento_".$lang;


        foreach ($tesisLeidas as $tesisLeida){
            $departamento = \App\Traits\Listados::listadoDepartamentos($lang)[$tesisLeida->departamento]??'---'  ;
            $doctorando   = false;
            if(!empty($tesisLeida->doctorandos)){
                $i = 0;
                $len = count($tesisLeida->doctorandos);
                foreach ($tesisLeida->doctorandos as $doctorando) {
                    if ($i == 0) {
                        $doctorando.= $doctorando->nombre ." ".$doctorando->apellido ;
                    } else if ($i == $len - 1) {
                        $doctorando.= ", ".$doctorando->nombre ." ".$doctorando->apellido ;
                    }else{
                        $doctorando.=", ".$doctorando->nombre ." ".$doctorando->apellido ;
                    }
                    $i++;
                }
            }
            $directorea = false;
            if(!empty($tesisLeida->directores)){
                $i = 0;
                $len = count($tesisLeida->directores);
                foreach ($tesisLeida->directores as $director) {
                    if ($i == 0) {
                        $directorea.= $director->nombre ." ".$director->apellido ;
                    } else if ($i == $len - 1) {
                        $directorea.= ", ".$director->nombre ." ".$director->apellido ;
                    }else{
                        $directorea.=", ".$director->nombre ." ".$director->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenbururua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($tesisLeida->$titulo);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zuzendaria') );
            $table->addCell($widthTD , $styleTD)->addText( $directorea );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Doktorando') );
            $table->addCell($widthTD , $styleTD)->addText( $doctorando );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Saila') );
            $table->addCell($widthTD , $styleTD)->addText($tesisLeida->$departamento);
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($tesisLeida->fechaLectura);
        }
        $section->addPageBreak();
    }

    public function wordProyectoEuropa( $section, $phpWord)
    {
        $proyectosEuropeos = Proyectos::where('tipo','europa')
         ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Europar Batasuneko Programa Markoa') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Europar Batasuneko Programa Markoa');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $proyecto = "proyecto_".$lang;


        foreach ($proyectosEuropeos as $proyectoEuropeo){
            $investigador = false;
            if(!empty($proyectoEuropeo->investigadores)){
                $i = 0;
                $len = count($proyectoEuropeo->investigadores);
                foreach ($proyectoEuropeo->investigadores as $investigador) {
                    if ($i == 0) {
                        $investigador.= $investigador->nombre ." ".$investigador->apellido ;
                    } else if ($i == $len - 1) {
                        $investigador.= ", ".$investigador->nombre ." ".$investigador->apellido ;
                    }else{
                        $investigador.=", ".$investigador->nombre ." ".$investigador->apellido ;
                    }
                    $i++;
                }
            }
            $directorea = false;
            if(!empty($proyectoEuropeo->directores)){
                $i = 0;
                $len = count($proyectoEuropeo->directores);
                foreach ($proyectoEuropeo->directores as $director) {
                    if ($i == 0) {
                        $directorea.= $director->nombre ." ".$director->apellido ;
                    } else if ($i == $len - 1) {
                        $directorea.= ", ".$director->nombre ." ".$director->apellido ;
                    }else{
                        $directorea.=", ".$director->nombre ." ".$director->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenbururua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($proyectoEuropeo->$proyecto);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zuzendaria') );
            $table->addCell($widthTD , $styleTD)->addText( $directorea );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Ikertazileak') );
            $table->addCell($widthTD , $styleTD)->addText( $investigador );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Finantziazioa') );
            $table->addCell($widthTD , $styleTD)->addText($proyectoEuropeo->financinacion);
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($proyectoEuropeo->desde." - ".$proyectoEuropeo->hasta);
        }
        $section->addPageBreak();
    }

    public function wordProyectoErakundeak( $section, $phpWord)
    {
        $proyectosEuropeos = Proyectos::where('tipo','erakundeak')
         ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $proyecto = "proyecto_".$lang;


        foreach ($proyectosEuropeos as $proyectoEuropeo){
            $investigador = false;
            if(!empty($proyectoEuropeo->investigadores)){
                $i = 0;
                $len = count($proyectoEuropeo->investigadores);
                foreach ($proyectoEuropeo->investigadores as $investigador) {
                    if ($i == 0) {
                        $investigador.= $investigador->nombre ." ".$investigador->apellido ;
                    } else if ($i == $len - 1) {
                        $investigador.= ", ".$investigador->nombre ." ".$investigador->apellido ;
                    }else{
                        $investigador.=", ".$investigador->nombre ." ".$investigador->apellido ;
                    }
                    $i++;
                }
            }
            $directorea = false;
            if(!empty($proyectoEuropeo->directores)){
                $i = 0;
                $len = count($proyectoEuropeo->directores);
                foreach ($proyectoEuropeo->directores as $director) {
                    if ($i == 0) {
                        $directorea.= $director->nombre ." ".$director->apellido ;
                    } else if ($i == $len - 1) {
                        $directorea.= ", ".$director->nombre ." ".$director->apellido ;
                    }else{
                        $directorea.=", ".$director->nombre ." ".$director->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenbururua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($proyectoEuropeo->$proyecto);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zuzendaria') );
            $table->addCell($widthTD , $styleTD)->addText( $directorea );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Ikertazileak') );
            $table->addCell($widthTD , $styleTD)->addText( $investigador );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Finantziazioa') );
            $table->addCell($widthTD , $styleTD)->addText($proyectoEuropeo->financinacion);
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($proyectoEuropeo->desde." - ".$proyectoEuropeo->hasta);
        }
        $section->addPageBreak();
    }

    public function wordProyectoEmpresak( $section, $phpWord)
    {
        $proyectosEuropeos = Proyectos::where('tipo','empresa')
         ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $proyecto = "proyecto_".$lang;


        foreach ($proyectosEuropeos as $proyectoEuropeo){
            $investigador = false;
            if(!empty($proyectoEuropeo->investigadores)){
                $i = 0;
                $len = count($proyectoEuropeo->investigadores);
                foreach ($proyectoEuropeo->investigadores as $investigador) {
                    if ($i == 0) {
                        $investigador.= $investigador->nombre ." ".$investigador->apellido ;
                    } else if ($i == $len - 1) {
                        $investigador.= ", ".$investigador->nombre ." ".$investigador->apellido ;
                    }else{
                        $investigador.=", ".$investigador->nombre ." ".$investigador->apellido ;
                    }
                    $i++;
                }
            }
            $directorea = false;
            if(!empty($proyectoEuropeo->directores)){
                $i = 0;
                $len = count($proyectoEuropeo->directores);
                foreach ($proyectoEuropeo->directores as $director) {
                    if ($i == 0) {
                        $directorea.= $director->nombre ." ".$director->apellido ;
                    } else if ($i == $len - 1) {
                        $directorea.= ", ".$director->nombre ." ".$director->apellido ;
                    }else{
                        $directorea.=", ".$director->nombre ." ".$director->apellido ;
                    }
                    $i++;
                }
            }
            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenbururua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($proyectoEuropeo->$proyecto);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zuzendaria') );
            $table->addCell($widthTD , $styleTD)->addText( $directorea );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Ikertazileak') );
            $table->addCell($widthTD , $styleTD)->addText( $investigador );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Finantziazioa') );
            $table->addCell($widthTD , $styleTD)->addText($proyectoEuropeo->financinacion);
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($proyectoEuropeo->desde." - ".$proyectoEuropeo->hasta);
        }
        $section->addPageBreak();
    }

    public function wordCongreso( $section, $phpWord)
    {
        $congresos = Congresos::where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Kongresu zientifikoentan parte-hartzea') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Kongresu zientifikoentan parte-hartzea');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $titCongreso = "congreso_".$lang;
        foreach ($congresos as $congreso){
            $profesora = false;
            if(!empty($congreso->profesores)){

                $i = 0;
                $len = count($congreso->profesores);
                foreach ($congreso->profesores as $profesor) {
                    if ($i == 0) {
                        $profesora.= $profesor->nombre ." ".$profesor->apellido ;
                    } else if ($i == $len - 1) {
                        $profesora.= ", ".$profesor->nombre ." ".$profesor->apellido ;
                    }else{
                        $profesora.=", ".$profesor->nombre ." ".$profesor->apellido ;
                    }
                    $i++;
                }
            }

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Kongresu') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($congreso->$titCongreso);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Tokia') );
            $table->addCell($widthTD , $styleTD)->addText( $congreso->lugar  );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Konferentzi/Posterra') );
            $table->addCell($widthTD , $styleTD)->addText( $congreso->conferenciaPoster );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Irakaslea') );
            $table->addCell($widthTD , $styleTD)->addText( $profesora );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($congreso->desde." - ".$congreso->hasta);
        }
        $section->addPageBreak();
    }

    public function wordPublicacionLibros( $section, $phpWord)
    {
        $publicaciones = Publicaciones::where('tipo','libros')
            ->whereBetween('year', [ $this->fechaDesde,  $this->fechaHasta ])
            ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Liburuak eta Monografiak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Liburuak eta Monografiak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $titulo = "titulo_".$lang;
        foreach ($publicaciones as $publicacion){
            $autora = false;
            if(!empty($publicacion->autores)){

                $i = 0;
                $len = count($publicacion->autores);
                foreach ($publicacion->autores as $autor) {
                    if ($i == 0) {
                        $autora.= $autor->nombre ." ".$autor->apellido ;
                    } else if ($i == $len - 1) {
                        $autora.= ", ".$autor->nombre ." ".$autor->apellido ;
                    }else{
                        $autora.=", ".$autor->nombre ." ".$autor->apellido ;
                    }
                    $i++;
                }
            }

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenburua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($publicacion->$titulo);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Argitaletxea / revista') );
            $table->addCell($widthTD , $styleTD)->addText( $publicacion->lugar  );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Kapituloa') );
            $table->addCell($widthTD , $styleTD)->addText( $publicacion->capitulo );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Egilea') );
            $table->addCell($widthTD , $styleTD)->addText( $autora );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($publicacion->desde." - ".$publicacion->hasta);
        }
        $section->addPageBreak();
    }

    public function wordPublicacionArticulos( $section, $phpWord)
    {
        $publicaciones = Publicaciones::where('tipo','articulos')
            ->whereBetween('year', [ $this->fechaDesde,  $this->fechaHasta ])
            ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Artikuloak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Artikuloak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $titulo = "titulo_".$lang;
        foreach ($publicaciones as $publicacion){
            $autora = false;
            if(!empty($publicacion->autores)){

                $i = 0;
                $len = count($publicacion->autores);
                foreach ($publicacion->autores as $autor) {
                    if ($i == 0) {
                        $autora.= $autor->nombre ." ".$autor->apellido ;
                    } else if ($i == $len - 1) {
                        $autora.= ", ".$autor->nombre ." ".$autor->apellido ;
                    }else{
                        $autora.=", ".$autor->nombre ." ".$autor->apellido ;
                    }
                    $i++;
                }
            }

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Izenburua') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($publicacion->$titulo);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Argitaletxea / revista') );
            $table->addCell($widthTD , $styleTD)->addText( $publicacion->lugar  );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Kapituloa') );
            $table->addCell($widthTD , $styleTD)->addText( $publicacion->capitulo );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Egilea') );
            $table->addCell($widthTD , $styleTD)->addText( $autora );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($publicacion->desde." - ".$publicacion->hasta);
        }
        $section->addPageBreak();
    }

    public function wordProgramaDeIntercambioFuera( $section, $phpWord)
    {
        $programasDeIntercambios = ProgramasDeIntercambio::where('tipo','fuera')
            ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Egonaldi zientifikoak beste Unibertsitateetan') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Egonaldi zientifikoak beste Unibertsitateetan');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $actividad = "actividad_".$lang;
        foreach ($programasDeIntercambios as $programaDeIntercambio){
            $profesora = false;
            if(!empty($programaDeIntercambio->profesores)){

                $i = 0;
                $len = count($programaDeIntercambio->profesores);
                foreach ($programaDeIntercambio->profesores as $profesor) {
                    if ($i == 0) {
                        $profesora.= $profesor->nombre ." ".$profesor->apellido ;
                    } else if ($i == $len - 1) {
                        $profesora.= ", ".$profesor->nombre ." ".$profesor->apellido ;
                    }else{
                        $profesora.=", ".$profesor->nombre ." ".$profesor->apellido ;
                    }
                    $i++;
                }
            }

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Aktibitatea') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($programaDeIntercambio->$actividad);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Tokia') );
            $table->addCell($widthTD , $styleTD)->addText( $programaDeIntercambio->lugar  );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Irakaslea') );
            $table->addCell($widthTD , $styleTD)->addText( $profesora );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($programaDeIntercambio->desde." - ".$programaDeIntercambio->hasta);
        }
        $section->addPageBreak();
    }

    public function wordProgramaDeIntercambioCasa( $section, $phpWord)
    {
        $programasDeIntercambios = ProgramasDeIntercambio::where('tipo','enCasa')
            ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

        $lang = \Session::get('locale');
        $section->addText( __('Etorritako ikerlariak') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Etorritako ikerlariak');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
        // Tabla contenido variable
        $actividad = "actividad_".$lang;
        foreach ($programasDeIntercambios as $programaDeIntercambio){
            $profesora = false;
            if(!empty($programaDeIntercambio->profesores)){

                $i = 0;
                $len = count($programaDeIntercambio->profesores);
                foreach ($programaDeIntercambio->profesores as $profesor) {
                    if ($i == 0) {
                        $profesora.= $profesor->nombre ." ".$profesor->apellido ;
                    } else if ($i == $len - 1) {
                        $profesora.= ", ".$profesor->nombre ." ".$profesor->apellido ;
                    }else{
                        $profesora.=", ".$profesor->nombre ." ".$profesor->apellido ;
                    }
                    $i++;
                }
            }

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Aktibitatea') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($programaDeIntercambio->$actividad);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Tokia') );
            $table->addCell($widthTD , $styleTD)->addText( $programaDeIntercambio->lugar  );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Irakaslea') );
            $table->addCell($widthTD , $styleTD)->addText( $profesora );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($programaDeIntercambio->desde." - ".$programaDeIntercambio->hasta);
        }
        $section->addPageBreak();
    }

    public function wordEquipoNuevo( $section, $phpWord)
    {
        $equiposNuevos = EquipamientoNuevo::where('data', '=',  $this->year)

        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');
        $section->addText( __('Hornikuntza Zientifikoa eskuratzea') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        // Tabla config
        $tableName     = __('Hornikuntza Zientifikoa eskuratzea');
        $tableStyle         = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $phpWord->addTableStyle($tableName, $tableStyle);
        $table           = $section->addTable($tableName);
        $styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $styleTH         = array( 'bgColor' => 'F1F1F1');
        $styleTD         = array( 'bgColor' => 'FFFFFF');
        $widthTH         = 3000;
        $widthTD         = 6550;
         // Tabla contenido variable
        $equipo = "equipo_".$lang;
        $departamento = "departamento_".$lang;
        foreach ($equiposNuevos as $equipoNuevo){

            $table->addRow();
            $table->addCell($widthTH , $styleFirstTHRow)->addText( __('Taldea') );
            $table->addCell($widthTD , $styleFirstTDRow)->addText($equipoNuevo->$departamento);
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Arduraduna') );
            $table->addCell($widthTD , $styleTD)->addText( $equipoNuevo->$equipo );
            $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Instituzioa') );
            $table->addCell($widthTD , $styleTD)->addText($equipoNuevo->institucion);
             $table->addRow();
            $table->addCell($widthTH , $styleTH)->addText(__('Zenbateko') );
            $table->addCell($widthTD , $styleTD)->addText($equipoNuevo->importe." €" );
            $table->addRow();
            $table->addCell($widthTH , $styleLastTHRow)->addText(__('Data') );
            $table->addCell($widthTD , $styleLastTDRow)->addText($equipoNuevo->data);
        }
        $section->addPageBreak();
    }
}

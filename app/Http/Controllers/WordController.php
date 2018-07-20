<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoInvestigacion;
use App\TesisDoctorales;
use App\Formaciones;
use App\Proyectos;
use App\Congresos;
use App\Postgrados;
use App\Visitas;
use App\Publicaciones;
use App\ProgramasDeIntercambio;
use App\EquipamientoNuevo;
use Carbon\Carbon;

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


    public function index()
    {
       return view('word.index') ;
    }



    public function create(Request $request)
    {
        $this->validate($request, [
            'year' => 'required',
            'mes'  => 'required',

        ]);
        $this->formatearYear($request['year'], $request['mes']);
        $this->setStyles();
        // Word sortu
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $this->indiceWord($phpWord,  $phpWord);
        // Sekzio guztiak sortu
        $this->wordPostgrados( $section, 'master', $phpWord );
        $this->wordPostgrados( $section, 'doctorando', $phpWord );
        $this->Formaciones( $section,  'PDI', 'recibir', $phpWord);
        $this->Formaciones( $section,  'PDI', 'dar', $phpWord);
        $this->Formaciones( $section,  'PAS', 'recibir', $phpWord);
        $this->Formaciones( $section,  'PAS', 'dar', $phpWord);
        $this->wordProgramaDeIntercambio( $section, 'azp', $phpWord);
        $this->wordVisitas( $section,  $phpWord);
        $this->wordGrupoInvestigacion( $section, $phpWord);
        $this->wordTesis( $section, 'tesisLeidas', $phpWord);
        $this->wordProyecto( $section, 'europa',  $phpWord);
        $this->wordProyecto( $section, 'erakundeak',  $phpWord);
        $this->wordProyecto( $section, 'empresa',  $phpWord);
        $this->wordCongreso( $section, $phpWord);
        $this->wordPublicacion( $section, 'libros', $phpWord);
        $this->wordPublicacion( $section, 'articulos', $phpWord);
        $this->wordProgramaDeIntercambio( $section, 'fuera', $phpWord);
        $this->wordProgramaDeIntercambio( $section, 'enCasa', $phpWord);
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
        return back()->with('success', __('Word zuzen sortu da'));
    }


    public function indiceWord($phpWord)
    {
        $section = $phpWord->addSection();
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        /*$fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(16);*/
        $section->addText(__('Gipuzkoako Ingeniaritza Eskola'), array('name' => 'Tahoma', 'size' => 20, 'bold' => true) );
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

        $section->addText(__('IKERKUNTZA JARDUERAK'), array('name' => 'Tahoma', 'size' => 13, 'bold' => true) );
        $section->addListItem( __('Graduondoko programak'), 0, null, 'multilevel');
        $section->addListItem( __('Masterretan parte-hartzea'), 1, null, 'multilevel');
        $section->addListItem( __('Doktoretzan parte-hartzea'), 1, null, 'multilevel');
        $section->addListItem( __('IIPko Formazioa Jarduerak'), 0, null, 'multilevel');
        $section->addListItem( __('Hartutako formazioa'), 1, null, 'multilevel');
        $section->addListItem( __('Emandako formazioa'), 1, null, 'multilevel');
        $section->addListItem( __('AZPko Formazioa Jarduerak'), 0, null, 'multilevel');
        $section->addListItem( __('Hartutako formazioa'), 1, null, 'multilevel');
        $section->addListItem( __('Emandako formazioa'), 1, null, 'multilevel');
        $section->addListItem( __('Elkartrukeko programak'), 0, null, 'multilevel');
        $section->addListItem( __('IIP /AZP mugikortasuna'), 1, null, 'multilevel');
        $section->addListItem( __('Instalazio bisitak'), 0, null, 'multilevel');

        $section->addText(__('ACTIVIDAD INVESTIGADORA') , array('name' => 'Tahoma', 'size' => 13, 'bold' => true));
        $section->addListItem( __('Ikerkuntza taldea'), 0, null, 'multilevel');
        $section->addListItem( __('Tesiak'), 0, null, 'multilevel');
        /*$section->addListItem( __('Uneko Tesiak'), 1, null, 'multilevel');
        $section->addListItem( __('Burutu diren Tesiak'), 1, null, 'multilevel');*/
        $section->addListItem( __('Ikerkuntza Proiektuak'), 0, null, 'multilevel');
        $section->addListItem( __('Europar Batasuneko Programa Markoa'), 1, null, 'multilevel');
        $section->addListItem( __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
        $section->addListItem( __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak'), 1, null, 'multilevel');
        $section->addListItem( __('Kongresu Zientifikoetan parte-hartzea'), 0, null, 'multilevel');
        $section->addListItem( __('Argitalpenak'), 0, null, 'multilevel');
        $section->addListItem( __('Liburuak eta Monografiak'), 1, null, 'multilevel');
        $section->addListItem( __('Artikuloak'), 0, null, 'multilevel');
        $section->addListItem( __('Elkartrukeko programak'), 0, null, 'multilevel');
        $section->addListItem( __('Egonaldi zientifikoak beste unibertsitateetan'), 1, null, 'multilevel');
        $section->addListItem( __('Etorritako ikerlariak'), 1, null, 'multilevel');
        $section->addListItem( __('Hornikuntza Zientifikoa eskuratzea'), 0, null, 'multilevel');
        $section->addPageBreak();
        return $section;
    }


    public function wordPostgrados( $section, $tipo, $phpWord)
    {
        $postgrados = Postgrados::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
            ->where('tipo', $tipo)
            ->orderBy('fecha','DESC')
            ->get();
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

    public function Formaciones( $section, $tipo, $modo, $phpWord)
    {
        $formaciones = Formaciones::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
            ->where('tipo', $tipo)
            ->where('modo', $modo)
            ->orderBy('fecha','DESC')
            ->get();
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
            $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Ikastaro'), $formacion->$titulo);
            if( $modo == 'recibir' ){
                $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Antolatzailea(k)'), $formacion->$organizador);
            }
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $formacion->lugar);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Iraupena'), $formacion->duracion);
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, $titAutor , $this->listadoAutores($formacion->autores));
        }
        $section->addPageBreak();
    }


    public function wordProgramaDeIntercambio( $section, $tipo, $phpWord)
    {
        $programasDeIntercambios = ProgramasDeIntercambio::where('tipo', $tipo)
            ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
        ->orderBy('id','DESC')->get();

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
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $autores , $this->listadoAutores($programaDeIntercambio->autores));
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data(k)'), $programaDeIntercambio->desde." / ".$programaDeIntercambio->hasta);
        }
        $section->addPageBreak();
    }

    public function wordVisitas( $section,  $phpWord)
    {
        $visitas = Visitas::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
            ->orderBy('fecha','DESC')
            ->get();
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

    public function wordGrupoInvestigacion( $section, $phpWord)
    {
        $gruposInvestigacion = GrupoInvestigacion::where('desde', '<=',  $this->year)
        ->where('hasta','>=', $this->year)
        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');
        $section->addText( __('Ikerkuntza taldea') , $this->styleH1 );
        $tableName     = __('Ikerkuntza taldea');
        $phpWord->addTableStyle($tableName, $this->tableStyle);
        $table           = $section->addTable($tableName);

        // Tabla contenido variable
        $grupo = "grupo_".$lang;
        $lineaInv = "lineasInv_".$lang;
        foreach ($gruposInvestigacion as $grupoInvestigacion){
            $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Taldea'), $grupoInvestigacion->$grupo);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $grupoInvestigacion->lugar);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Arduraduna(k)'), $this->listadoAutores($grupoInvestigacion->responsables));
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kidea(k)'), $this->listadoAutores($grupoInvestigacion->participantes ));
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), $grupoInvestigacion->$lineaInv );
        }
        $section->addPageBreak();
    }

    public function wordTesis( $section, $tipo,  $phpWord)
    {
        //Esta montado porsi con tipo pq hay dos leidas por leer pero ahora voy a poner siempre leida
        $tesisLeidas = TesisDoctorales::where('tipo','tesisLeidas')
        ->whereBetween('fechaLectura', [ $this->fechaDesde,  $this->fechaHasta ])
        ->orderBy('id','DESC')->get();
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

    public function wordProyecto( $section, $tipo,  $phpWord)
    {
        //Esta montado porsi con tipo pq hay dos leidas por leer pero ahora voy a poner siempre leida
         $proyectos = Proyectos::where('tipo', $tipo)
         ->where(function ($query)  {
              $query->where('desde', '>=', $this->fechaDesde);
              $query->where('desde', '<=', $this->fechaHasta);
              $query->orWhere('hasta', '>=', $this->fechaDesde);
              $query->where('hasta', '<=', $this->fechaHasta);
          })
          ->orderBy('id','DESC')->get();
    ;
        if( $tipo == 'europa' ){
            $tituloH1 = __('Europar Batasuneko Programa Markoa') ;
        }elseif( $tipo == 'erakundeak' ){
            $tituloH1 = __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak');
        }else{
            $tituloH1 = __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak');
        }
        $lang      = \Session::get('locale');
        $tableName = $tituloH1;

        $section->addText( $tituloH1 , $this->styleH1  );
        $phpWord->addTableStyle($tableName, $this->tableStyle);
        $table     = $section->addTable($tableName);
        // Tabla contenido variable
        $titPproyecto = "proyecto_".$lang;

        foreach ($proyectos as $proyecto){
            $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Izenbururua'), $proyecto->$titPproyecto);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Zuzendaria(k)'), $this->listadoAutores($proyecto->directores));
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Ikertzailea(k)'), $this->listadoAutores($proyecto->investigadores ));
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Izenbururua'), $proyecto->financinacion);
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data'), $proyecto->desde." / ".$proyecto->hasta );

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


    public function wordPublicacion( $section, $tipo,  $phpWord)
    {
        //Esta montado porsi con tipo pq hay dos leidas por leer pero ahora voy a poner siempre leida
        $publicaciones = Publicaciones::where('tipo', $tipo)
            ->whereBetween('year', [  $this->year,  $this->year+1 ])
            ->orderBy('id','DESC')->get();
        if( $tipo == 'libros' ){
            $tituloH1 = __('Liburuak eta Monografiak') ;
            $capi     = __('Kapituloa');
        }else{
            $tituloH1 = __('Artikuloak');
            $capi     = __('Bolumena');
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
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Argitaletxea / revista'), $publicacion->editorialRevisa);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $capi , $publicacion->capitulo);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Egilea(k)'), $this->listadoAutores($publicacion->autores));
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Urtea'), $publicacion->year );
        }
        $section->addPageBreak();
    }


    public function wordEquipoNuevo( $section, $phpWord)
    {
        $equiposNuevos = EquipamientoNuevo::where('data', '=',  $this->year)

        ->orderBy('id','DESC')->get();
        $lang = \Session::get('locale');

        $tituloH1 = __('Hornikuntza Zientifikoa eskuratzea');

        $lang      = \Session::get('locale');
        $tableName = $tituloH1;
        $section->addText( $tituloH1 , $this->styleH1  );
        $phpWord->addTableStyle($tableName, $this->tableStyle);
        $table     = $section->addTable($tableName);


         // Tabla contenido variable
        $equipo = "equipo_".$lang;

        foreach ($equiposNuevos as $equipoNuevo){
            $table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Taldea'), $equipoNuevo->$equipo );
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Saila'),  \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$equipoNuevo->departamento]??'---' );
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Instituzioa'), $equipoNuevo->institucion);
            $table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Zenbateko'), $equipoNuevo->importe." €");
            $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data'), $equipoNuevo->data );
        }
        $section->addPageBreak();
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
        $this->tableStyle      = array('borderSize' => 6, 'borderColor' => 'CCCCCC', 'cellMargin' => 30, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $this->styleFirstTHRow = array( 'bgColor' => 'F1F1F1', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $this->styleFirstTDRow = array( 'bgColor' => 'FFFFFF', 'borderTopSize' => 12, 'borderTopColor' => '000000');
        $this->styleLastTHRow  = array( 'bgColor' => 'F1F1F1', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $this->styleLastTDRow  = array( 'bgColor' => 'FFFFFF', 'borderBottomSize' => 12, 'borderBottomColor' => '000000');
        $this->styleTH         = array( 'bgColor' => 'F1F1F1');
        $this->styleTD         = array( 'bgColor' => 'FFFFFF');
        $this->widthTH         = 3000;
        $this->widthTD         = 6550;
        $this->styleH1         = array('name' => 'Tahoma', 'size' => 13, 'bold' => true);
    }

    private function pintaLineaTabla($table, $styleTH, $styleTD, $tit, $valor)
    {
        $table->addRow();
        $table->addCell($this->widthTH , $styleTH)->addText( htmlspecialchars($tit) );
        $table->addCell($this->widthTD , $styleTD)->addText( htmlspecialchars($valor) );
        return $table;
    }

}

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
use App\Divulgacion;
use App\Ekintzak;
use App\EkintzakAurretik;
use App\EkintzakGizartea;
use Carbon\Carbon;
use App\Lib\Functions;
use App\Traits\Listados;
use Session;
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
	private $styleH ;
	private $styleH1 ;
	private $styleH2 ;
	private $styleH3 ;
	private $styleP  ;
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
		// #####################	EMPIEZA EL INDICE #################
		$section = $this->indiceWord($phpWord, $request );
		
		// #####################	EMPIEZA EL CONTENIDO #################
		$this->crearTitulo($section, "1-".mb_strtoupper ( __('Sarrera') ), $this->styleH  );
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$section->addPageBreak();
		$this->crearTitulo($section, "2-".mb_strtoupper ( __('Giza baliabideak') ), $this->styleH);
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$section->addPageBreak();
		$this->crearTitulo($section, "3-".mb_strtoupper ( __('Baliabide ekonomikoak') ), $this->styleH);
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$section->addPageBreak();
		$this->crearTitulo($section, "4-".mb_strtoupper ( __('Baliabide orokorrak') ), $this->styleH);
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$section->addPageBreak();
		$this->crearTitulo($section, "5-".mb_strtoupper ( __('IRAKASKUNTZA-JARDUERAK') ), $this->styleH);
		$this->crearTitulo($section, "5.1-".__('Irakaskuntza-eskaintza') , $this->styleH1);
		$this->crearTitulo($section, "5.1.1-".__('Graduak') , $this->styleH2);
		
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$this->crearTitulo($section,  "5.1.2-".__('Gradu bikoitzak') , $this->styleH2);
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
		$this->crearTitulo($section,  "5.1.2-".__('Graduondokoak') , $this->styleH2);
		$section->addText(  "Lorem ipsum dolor sit amet consectetur adipiscing elit, vitae neque augue sociosqu curae congue tempor netus, faucibus semper mauris condimentum viverra consequat. Porta aliquet nisi etiam parturient ridiculus cum aenean sem fermentum luctus, himenaeos mauris interdum volutpat fusce auctor hendrerit nam nostra. Augue at fringilla tristique porta convallis justo non, habitant euismod nulla ornare quam." , $this->styleP  );
	
		//5.2
		if (in_array("13", $request['secciones'])) {
			$this->crearTitulo($section,  "5.2-".__('Unibertsitate aurreko ikasleei bideratutako ekintzak') , $this->styleH1);
			$this->wordEkintzakAurretik( $section, $request, $phpWord );
		}
	
		//5.3 
		if (in_array("14", $request['secciones'])) {
			$this->crearTitulo($section,  "5.3-".__('Eskolako ikasleei bideratutako ekintzak') , $this->styleH1);
			$this->wordEkintzak( $section, $request, 'laguntza', $phpWord );	
			$this->wordEkintzak( $section, $request, 'formakuntzaOsagarriak', $phpWord );
		}
		
		//5.4
		if (in_array("3", $request['secciones'])) {
			$this->crearTitulo($section,  "5.4-".__('IRIen formakuntza-jarduerak') , $this->styleH1);
			$this->Formaciones( $section, $request,  'PDI', 'recibir', $phpWord);
			$this->Formaciones( $section, $request,  'PDI', 'dar', $phpWord);
		}
		
		//5.5
		if (in_array("4", $request['secciones'])) {
			$this->crearTitulo($section,  "5.5-".__('Elkartrukeko programak: IRI/AZPen mugikortasuna (Staff Movility)') , $this->styleH1);
			$this->wordProgramaDeIntercambio( $section, $request, 'PIfuera', $phpWord);
			$this->wordProgramaDeIntercambio( $section, $request, 'PIvisita', $phpWord);
		}
		$section->addPageBreak();	
		// 6 
		if (in_array("3", $request['secciones'])) {
			$this->crearTitulo($section,  mb_strtoupper ( "6-".__('AZP-EN FORMAKUNTZA-JARDUERAK') ) , $this->styleH);
			$this->Formaciones( $section, $request,  'PAS', 'recibir', $phpWord);
			$this->Formaciones( $section, $request,  'PAS', 'dar', $phpWord);
		}
		$section->addPageBreak();
		// 7
		$this->crearTitulo($section,  "7-".__('IKERKUNTZA-JARDUERA') , $this->styleH);
		// 7.1
		if (in_array("6", $request['secciones'])) {
			$this->crearTitulo($section,  "7.1-".__('Ikerkuntza taldea') , $this->styleH1);
			$this->wordGrupoInvestigacion( $section, $request, $phpWord);
		}
		
		// 7.2
		if (in_array("7", $request['secciones'])) {
			$this->crearTitulo($section,  "7.2-".__('Tesiak') , $this->styleH1);
			$this->wordTesis( $section, $request, 'tesisLeidas', $phpWord);
		}
		// 7.3
		if (in_array("10", $request['secciones'])) {
			$this->crearTitulo($section,  "7.3-".__('Ikerkuntza Proiektuak') , $this->styleH1);
			$this->wordProyectos( $section, $request,  'europa',  $phpWord);
			$this->wordProyectos( $section, $request,  'erakundeak',  $phpWord);
			$this->wordProyectos( $section, $request,  'empresa',  $phpWord);
		}
		
		// 7.4
		if (in_array("11", $request['secciones'])) {
			$this->crearTitulo($section, "7.4-". __('Kongresu zientifikoentan parte-hartzea'), $this->styleH1);
			$this->wordCongreso( $section, $request, $phpWord);
		}
		
		// 7.5
		if (in_array("12", $request['secciones'])) {
			$this->crearTitulo($section,  "7.5-". __('Argitalpenak'), $this->styleH1);
			$this->wordPublicacion( $section, $request, 'libros', $phpWord);
			$this->wordPublicacion( $section, $request, 'articulos', $phpWord);
		}
		
		// 7.6
		if (in_array("4", $request['secciones'])) {
			$this->crearTitulo($section,  "7.6-". __('Egonaldi zientifikoak'), $this->styleH1);
			$this->wordProgramaDeIntercambio( $section, $request, 'ECfuera', $phpWord);
			$this->wordProgramaDeIntercambio( $section, $request, 'ECvisita', $phpWord);
		}
		
		// 7.7
		if (in_array("9", $request['secciones'])) {
			$this->crearTitulo($section,  "7.7-". __('Hornikuntza zientifikoaren eskurapena'), $this->styleH1);
			$this->wordEquipoNuevo( $section, $request, $phpWord);
		}
		$section->addPageBreak();
		// 8
		if (in_array("15", $request['secciones'])) {
			$this->crearTitulo($section,  "8-". mb_strtoupper ( __('GIZARTE-ERANTZUKIZUNEKO EKINTZAK') ), $this->styleH);
			$this->wordEkintzakGizartea( $section, $request, $phpWord );
		}
		$section->addPageBreak();
		//9
		if (in_array("16", $request['secciones'])) {
			$this->crearTitulo($section,  "9-". mb_strtoupper ( __('Eskolaren hedakuntza') ), $this->styleH);
			$this->wordDivulgacion( $section, $request, 'hedakuntza', $phpWord );
			$this->wordDivulgacion( $section, $request, 'prensa', $phpWord );
		}
		
		
/*		
		################### HAU ORAIN EZ DA ERABILTZEN BIHAR ..... BATEK DAKI ################
		if (in_array("5", $request['secciones'])) {
			$this->wordVisitas( $section, $request,  $phpWord);
		}
		if (in_array("2", $request['secciones'])) {
			$this->wordPostgrados( $section, $request, 'master', $phpWord );
			// $this->wordPostgrados( $section, $request, 'doctorando', $phpWord );
		}
*/

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

	public function indiceWord($phpWord, $request )
	{
		  $section   = $phpWord->addSection();
		  $lang      = $request->lng ;
		  $secciones = $request['secciones'];
		  $fontStyle = new \PhpOffice\PhpWord\Style\Font();
		/*$fontStyle->setBold(true);
		$fontStyle->setName('Tahoma');
		$fontStyle->setSize(16);*/
		$section->addText(__('Gipuzkoako Ingeniaritza Eskola'), array('name' => $this->fuente, 'size' => 20, 'bold' => true) );
		if( $request->lng == 'es' ){
			$desde = Carbon::parse($request->desde)->format('d-m-Y');
			$hasta = Carbon::parse($request->hasta)->format('d-m-Y');
			$section->addText("( ".$desde." / ".$hasta." )", array('name' => $this->fuente, 'size' => 12, 'bold' => false) );
		}else{
			$section->addText("( ".$this->fechaDesde." / ".$this->fechaHasta." )", array('name' => $this->fuente, 'size' => 12, 'bold' => false) );
		}
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
			
		$section->addListItem( mb_strtoupper ( __('Sarrera') ), 0, null, 'multilevel');
		$section->addListItem( mb_strtoupper ( __('Giza baliabideak') ), 0, null, 'multilevel');
		$section->addListItem( mb_strtoupper ( __('Baliabide ekonomikoak') ), 0, null, 'multilevel');
		$section->addListItem( mb_strtoupper ( __('Baliabide orokorrak') ), 0, null, 'multilevel');
		if ( in_array("2", $secciones) OR in_array("3", $secciones) OR in_array("4", $secciones) OR in_array("5", $secciones) OR in_array("13", $secciones) OR in_array("14", $secciones)) {
			$section->addListItem( __('IRAKASKUNTZA-JARDUERAK'), 0, null, 'multilevel');
			$section->addListItem( __('Irakaskuntza-eskaintza'), 1, null, 'multilevel');
				$section->addListItem( __('Graduak'), 2, null, 'multilevel');
				$section->addListItem( __('Gradu bikoitzak'), 2, null, 'multilevel');
				$section->addListItem( __('Graduondokoak'), 2, null, 'multilevel');
			if (in_array("13", $secciones)) {
				$section->addListItem( __('Unibertsitate aurreko ikasleei bideratutako ekintzak'), 1, null, 'multilevel');
				$ekintzakAurretik = $this->wordEkintzakAurretikObjeto();
				if(!$ekintzakAurretik->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($ekintzakAurretik as $ekintzaAurretik){
						$section->addListItem( $ekintzaAurretik->$titulo, 2, null, 'multilevel');
					}
				}
				
			}
			if (in_array("14", $secciones)) {
				$section->addListItem( __('Eskolako ikasleei bideratutako ekintzak'), 1, null, 'multilevel');
				$section->addListItem( __('Bidelaguntza'), 2, null, 'multilevel');
				$ekintzak= $this->wordEkintzakObjeto('laguntza');
				if(!$ekintzak->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($ekintzak as $ekintza){
						$section->addListItem( $ekintza->$titulo, 3, null, 'multilevel');
					}
				}
				$section->addListItem( __('Formakuntza Osagarriak'), 2, null, 'multilevel');
				$ekintzak= $this->wordEkintzakObjeto('formakuntzaOsagarriak');
				if(!$ekintzak->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($ekintzak as $ekintza){
						$section->addListItem( $ekintza->$titulo, 3, null, 'multilevel');
					}
				}
			}
			if (in_array("3", $secciones)) {
				$section->addListItem( __('IRIen formakuntza-jarduerak'), 1, null, 'multilevel');
				$section->addListItem( __('Jasotakoa'), 2, null, 'multilevel');
				$section->addListItem( __('Emandakoa'), 2, null, 'multilevel');
			}
			
			if (in_array("4", $secciones)) {
				$section->addListItem( __('Elkartrukeko programak: IRI/AZPen mugikortasuna (Staff Movility) '), 1, null, 'multilevel');
					$section->addListItem( __('Beste unibertsitateetan'), 2, null, 'multilevel');//PIFuera --> AZP
					$section->addListItem( __('Bisitariak'), 2, null, 'multilevel');//PIVisita --> enCasa
			}
		
		}
		if (in_array("3", $secciones)) {
			$section->addListItem( mb_strtoupper ( __('AZP-EN FORMAKUNTZA-JARDUERAK') ), 0, null, 'multilevel');
			$section->addListItem( __('Jasotakoa'), 1, null, 'multilevel');
			$section->addListItem( __('Emandakoa'), 1, null, 'multilevel');
		}

		
		if ( in_array("6", $secciones) OR in_array("7", $secciones) OR in_array("9", $secciones) OR in_array("10", $secciones) OR in_array("11", $secciones) OR in_array("12", $secciones) OR in_array("4", $secciones)) {
			$section->addListItem( __('IKERKUNTZA-JARDUERA'), 0, null, 'multilevel');
				if (in_array("6", $secciones)) {
					$section->addListItem( __('Ikerkuntza taldea'), 1, null, 'multilevel');
				}
		
				if (in_array("7", $secciones)) {
					$section->addListItem( __('Tesiak') , 1, null, 'multilevel');
				}
		
				if (in_array("10", $secciones)) {
					$section->addListItem( __('Ikerkuntza-proiektuak'), 1, null, 'multilevel');
					$section->addListItem( __('Europar Batasuneko Programa Markoa'), 2, null, 'multilevel');
					$section->addListItem( __('Erakundeek diru-laguntza emandako Ikerkuntza-proiektuak'), 2, null, 'multilevel');
					$section->addListItem( __('Enpresek diru-laguntza emandako Ikerkuntza-proiektuak'), 2, null, 'multilevel');
		
				}
		
				if (in_array("11", $secciones)) {
					$section->addListItem( __('Kongresu Zientifikoetan parte-hartzea'), 1, null, 'multilevel');
				}
		
				if (in_array("12", $secciones)) {
					$section->addListItem( __('Argitalpenak'), 1, null, 'multilevel');
					$section->addListItem( __('Liburuak eta Monografiak'), 2, null, 'multilevel');
					$section->addListItem( __('Artikuluak'), 2, null, 'multilevel');
				}
				if (in_array("4", $secciones)) {
					$section->addListItem( __('Egonaldi zientifikoak'), 1, null, 'multilevel');
					$section->addListItem( __('Beste Unibertsitateetan'), 2, null, 'multilevel');//ECFuera --> fuera
					$section->addListItem( __('Bisitariak'), 2, null, 'multilevel');//ECVisita --> No habia
				}
				if (in_array("9", $secciones)) {
					$section->addListItem( __('Hornikuntza Zientifikoa eskurapena'), 1, null, 'multilevel');
				}
		}
		if ( in_array("15", $secciones)   ) {
			if (in_array("15", $secciones)) {
				$section->addListItem( mb_strtoupper ( __('Gizarte-erantzukizuneko ekintzak') ), 0, null, 'multilevel');
				$ekintzakGizartea= $this->wordEkintzakGizarteaObjeto();
				if(!$ekintzakGizartea->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($ekintzakGizartea as $ekintza){
						$section->addListItem( $ekintza->$titulo, 1, null, 'multilevel');
					}
				}

			}
		}
		if (  in_array("16", $secciones)  ) {	
			if (in_array("16", $secciones)) {
				$section->addListItem( mb_strtoupper ( __('Eskolaren hedakuntza') ), 0, null, 'multilevel');
				$section->addListItem( __('Ekitaldiak'), 1, null, 'multilevel');
				$divulgaciones= $this->wordDivulgacionObjeto('hedakuntza');
				if(!$divulgaciones->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($divulgaciones as $ekintza){
						$section->addListItem( $ekintza->$titulo, 2, null, 'multilevel');
					}
				}
				$section->addListItem( __('Hedabideak'), 1, null, 'multilevel');
				$divulgaciones= $this->wordDivulgacionObjeto('prensa');
				if(!$divulgaciones->isEmpty()){
					$titulo    = "titulo_".$lang ;
					$desc      = "desc_".$lang ;
					foreach ($divulgaciones as $ekintza){
						$section->addListItem( $ekintza->$titulo, 2, null, 'multilevel');
					}
				}
			}	
		}
		
/*
VISITAS HA DESAPARECIDO COMO TAL 	
if (in_array("5", $secciones)) {
	$section->addListItem( __('Instalazio bisitak'), 1, null, 'multilevel');
}
*/

		$section->addPageBreak();
		return $section;
	}
	/*public function crearTitulo($section, $phpWord, $request, $titulo)
	{
		$section->addText( $titulo , array('name' => $this->fuente, 'size' => 20, 'bold' => true) );
		$section->addText( "7.3-".__('Ikerkuntza Proiektuak') , $this->styleH1  );
	}*/
	
	public function crearTitulo($section, $titulo, $estilo)
	{
		$section->addText( $titulo , $estilo );
	}
	
	//######################## SEKZIO BAKOITZAN FUNTZIOAK ##############################
	public function wordEkintzakAurretikObjeto ()
	{
		$ekintzakAurretik = false;
		if(  $this->unico  ){
			$ekintzakAurretik = EkintzakAurretik::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('fecha','DESC')
			->get();
		}else{
			$ekintzakAurretik = EkintzakAurretik::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->orderBy('fecha','DESC')
			->get();
		}
		return $ekintzakAurretik;
	}
	public function wordEkintzakAurretik( $section, $request, $phpWord)
	{
	
		$ekintzakAurretik = $this->wordEkintzakAurretikObjeto();

		if(!$ekintzakAurretik->isEmpty()){
		
			$lang      = $request->lng ;
			$cont = 1 ; 
			$titulo    = "titulo_".$lang ;
			$desc      = "desc_".$lang ;
			
			foreach ($ekintzakAurretik as $ekintzaAurretik){
				$this->crearTitulo($section, "5-2-".$cont."-".$ekintzaAurretik->$titulo , $this->styleH2);
				$section->addText(  __('Data').": ".$ekintzaAurretik->fecha , $this->styleP  );
				\PhpOffice\PhpWord\Shared\Html::addHtml($section, \App\Traits\Listados::limpiarAtributosHtml( ($ekintzaAurretik->$desc) ) );
				$cont = $cont + 1 ;
			}
			
		}
	}
	
	public function wordEkintzakObjeto($tipo)
	{
		$ekintzak = false;
			if(  $this->unico  ){
			$ekintzak = Ekintzak::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where('tipo',$tipo)
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('fecha','DESC')
			->get();
		}else{
			$ekintzak = Ekintzak::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where('tipo',$tipo)
			->orderBy('fecha','DESC')
			->get();
		}
		return $ekintzak;
	}

	public function wordEkintzak( $section, $request, $tipo, $phpWord)
	{
	
		$ekintzak= $this->wordEkintzakObjeto($tipo);
		if(!$ekintzak->isEmpty()){
			if( $tipo == 'laguntza' ){
				$titCont = "5-3-1-";
				$tituloH1 = $titCont.__('Bidelaguntza') ;
			}else{
				$titCont = "5-3-2-";
				$tituloH1 = $titCont.__('Formakuntza Osagarriak');
			}
			$section->addText( $tituloH1 , $this->styleH2  );
		    $lang   = $request->lng ;
		    $titulo = "titulo_".$lang ;
		    $desc   = "desc_".$lang ;
		    $cont   = 1;
			foreach ($ekintzak as $ekintza){
				$this->crearTitulo($section,  $titCont.$cont."-".$ekintza->$titulo , $this->styleH3);
				$section->addText(  __('Data').": ".$ekintza->fecha , $this->styleP  );
				\PhpOffice\PhpWord\Shared\Html::addHtml($section, \App\Traits\Listados::limpiarAtributosHtml(($ekintza->$desc)) );
				$cont = $cont + 1;
			}
		}
	}
	
	public function Formaciones( $section, $request, $tipo, $modo, $phpWord)
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
		if( !$formaciones->isEmpty() ){
			if( $tipo == 'PAS' ){
				$titCont = "6-";
				$styloTitulo = $this->styleH1;
				$tituloH1 = $titCont.__('AZKko formazioa ') ;
			}else{
				$titCont = "5.4-";
				$styloTitulo = $this->styleH2;
				$tituloH1 = $titCont .__('IIPko formazioa ');
				
			}
			if( $modo == 'recibir' ){
				$titCont2 = "1-";
				$tituloH2 = $titCont.$titCont2.__('Jasotakoa') ;
				$titAutor = __('Parte-hartzailea(k)');
			}else{
				$titCont2 = "2-";
				$tituloH2 = $titCont.$titCont2.__('Emandakoa');
				$titAutor = __('Hizlaria(k)');
			}
			$lang      = \Session::get('locale');
			$lang      = $request->lng ;
			$tableName = $tituloH1;

			$this->crearTitulo($section, $tituloH2 , $styloTitulo);
			
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
		}
	}

	public function wordProgramaDeIntercambio( $section, $request, $tipo, $phpWord)
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
		if( !$programasDeIntercambios->isEmpty() ){
			if( $tipo == 'PIfuera' ){
				$cont = "5.5.1-";
				$tituloH1 = __('IIP / AZPren mugikortasuna') ;
				$autores =  __('IIP / AZP');
			}elseif( $tipo == 'ECfuera' ){
				$cont = "7.6.1-";
				$tituloH1 = __('Egonaldiak / Beste Unibertsitateetan bisita');
				$autores =  __('Ikerlaria(k)');
			}elseif( $tipo == 'PIvisita' ){
				$cont = "5.5.2-";
				$tituloH1 = __('Elkartrukeko programak / mugikortasuna');
				$autores =  __('Ikerlaria(k)');
			}else{
				//enCasa
				$cont = "7.6.2-";
				$tituloH1 = __('Etorritako ikerlariak');
				$autores =  __('Ikerlaria(k)');
			}

			$lang = \Session::get('locale');
			$lang      = $request->lng ;

			$this->crearTitulo($section,  $cont.$tituloH1 , $this->styleH2);


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
		}
	}

	
	
	
	
	public function wordPostgrados( $section, $request, $tipo, $phpWord)
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

		if(!$postgrados->isEmpty() ){
			if( $tipo == 'master' ){
				$tituloH1 = __('Masterretan parte-hartzea') ;
			}else{
				$tituloH1 = __('Doktoretza-programetan parte-hartzea');
			}
			$lang      = \Session::get('locale');
			$lang      = $request->lng ;

			$tableName = $tituloH1;

			$section->addText( __('Graduondoko Programak') , $this->styleH1  );
			$section->addText(  $tituloH1 , $this->styleH2  );
			$phpWord->addTableStyle($tableName, $this->tableStyle);

			$table     = $section->addTable($tableName);
			$titulo    = "titulo_".$lang;
			$curso     = "curso_".$lang;


			foreach ($postgrados as $postgrado){
				$table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Programa'), $postgrado->$titulo);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Saila'), \App\Traits\Listados::listadoDepartamentos( $lang )[$postgrado->departamento]??'---' );
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kurtsoa'), $postgrado->$curso);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Irakaslea(k)'), $this->listadoAutores($postgrado->autores));
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Tokia'), $postgrado->lugar);
				$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Iraupena'), $postgrado->duracion);
			}
		}
	}

	


	




	public function wordVisitas( $section,  $request, $phpWord)
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
		if( !$visitas->isEmpty() ){
			$tituloH1 = __('Bisitak') ;

			$lang      = \Session::get('locale');
			$lang      = $request->lng ;
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
			//$section->addPageBreak();
		}
	}

	public function wordGrupoInvestigacion( $section, $request, $phpWord)
	{

		$fechaDesde = Carbon::parse($this->fechaDesde);
		$fechaHasta = Carbon::parse($this->fechaHasta);
		if(  $this->unico  ){
			$gruposInvestigacion = GrupoInvestigacion::where('desde', '>=',  $fechaDesde->format('Y'))
			->where('hasta','<=',  $fechaHasta->format('Y'))
			->orWhereNull('hasta')
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
				$query->orWhereIN('id', GrupoInvestigacionParticipantes::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
				$query->orWhereIN('id', GrupoInvestigacionResponsables::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
			})
			->orderBy('id','DESC')->get();
		}else{
			// dd( "hasta".$fechaHasta->format('Y')." / desde".$fechaDesde->format('Y') );
			$gruposInvestigacion = GrupoInvestigacion::where('desde', '>=',  $fechaDesde->format('Y'))
			->where('hasta','<=',  $fechaHasta->format('Y'))
			->orWhereNull('hasta')
			->orderBy('id','DESC')->get();
		}
		if( !$gruposInvestigacion->isEmpty() ){
			$lang      = \Session::get('locale');
			$lang      = $request->lng ;
			
		
			$tableName = __('Ikerkuntza taldea');
			$phpWord->addTableStyle($tableName, $this->tableStyle);
			$table     = $section->addTable($tableName);

			// Tabla contenido variable
			$grupo    = "grupo_".$lang;
			$lineaInv = "lineasInv_".$lang;
//dd($gruposInvestigacion);
//die( $lineaInv );

			foreach ($gruposInvestigacion as $grupoInvestigacion){
				$table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Taldea'), $grupoInvestigacion->$grupo);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Datak'), $grupoInvestigacion->desde??''.'-'.$grupoInvestigacion->hasta??'...' );
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Arduraduna(k)'), $this->listadoAutores($grupoInvestigacion->responsables));
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Ikerlaria(k)'), $this->listadoAutores($grupoInvestigacion->participantes ));
				$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), \App\Traits\Listados::limpiarAtributosHtml($grupoInvestigacion->$lineaInv ));
				//$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), $grupoInvestigacion->$lineaInv );
				// $table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Ikerketa Lerroak'), 	\PhpOffice\PhpWord\Shared\Html::addHtml($section, \App\Traits\Listados::limpiarAtributosHtml( ($grupoInvestigacion->$lineaInv) ) ) );
			}
		}
	}


	public function wordTesis( $section, $request, $tipo,  $phpWord)
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
		if( !$tesisLeidas->isEmpty() ){
		
			$lang      = \Session::get('locale');
			$lang      = $request->lng ;
			$tableName = __('Tesiak') ;

			
			$phpWord->addTableStyle($tableName, $this->tableStyle);
			$table     = $section->addTable($tableName);
			// Tabla contenido variable
			$titulo = "titulo_".$lang;

			foreach ($tesisLeidas as $tesis){
				$table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Izenbururua'), $tesis->$titulo);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Zuzendaria(k)'), $this->listadoAutores($tesis->directores));
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Doktorando(k)'), $this->listadoAutores($tesis->doctorandos ));
				$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Saila'), \App\Traits\Listados::listadoDepartamentos($lang )[$tesis->departamento]??'---' );

			}
		}
	}

	public function wordProyectos( $section, $request, $tipo, $phpWord)
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
		if( !$proyectos->isEmpty() ){
			if( $tipo == 'europa' ){
				$tituloH1 = "7.3.1-".__('Europar Batasuneko Programa Markoa') ;
			}elseif( $tipo == 'erakundeak' ){
				$tituloH1 = "7.3.2-".__('Erakundeek diru-laguntza emandako Ikerkuntza-proiektuak');
			}else{
				//empresa
				$tituloH1 = "7.3.3-".__('Enpresek diru-laguntza emandako Ikerkuntza-proiektuak');
			}

			$lang = \Session::get('locale');
			$lang = $request->lng ;
			$this->crearTitulo($section,  $tituloH1 , $this->styleH2);
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
		}
	}


	public function wordCongreso( $section, $request, $phpWord)
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
		if( !$congresos->isEmpty() ){
			//Txapuza pq gettex no saca de traits
			$tit1 = __('Aukeratu');
			$tit2 = __('Hitzaldi gonbidatua');
			$tit3 = __('Ahozko aurkezpena');
			$tit4 = __('Posterra');

			$lang = \Session::get('locale');
			$lang = $request->lng ;
		
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
		}
	}

	public function wordPublicacion( $section, $request, $tipo,  $phpWord)
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
		if( !$publicaciones->isEmpty() ){
			if( $tipo == 'libros' ){
				$tituloH1 = "7.5.1-".__('Liburuak eta Monografiak') ;
				$titArgitaletxea= __('Argitaletxea');
				$tituloISBN = "ISBN";
			}else{
				$tituloH1 = "7.5.2-".__('Artikuluak');
				$titArgitaletxea= __('Aldizkariak');
				$tituloISBN = "ISSN";
			}

			$lang      = \Session::get('locale');
			$lang      = $request->lng ;

			$tableName = $tituloH1;
			$this->crearTitulo($section, $tituloH1, $this->styleH2);
			$phpWord->addTableStyle($tableName, $this->tableStyle);
			$table     = $section->addTable($tableName);
			// Tabla contenido variable
			$titulo = "titulo_".$lang;

			foreach ($publicaciones as $publicacion){
				$table = $this->pintaLineaTabla($table, $this->styleFirstTHRow, $this->styleFirstTDRow, __('Izenbururua'), $publicacion->$titulo);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $titArgitaletxea , $publicacion->editorialRevisa);
				if(  $tipo  =="libros" ){
					$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Kapituloa'), $publicacion->capitulo);
				}
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, $tituloISBN , $publicacion->ISBN);
				$table = $this->pintaLineaTabla($table, $this->styleTH, $this->styleTD, __('Egilea(k)'), $this->listadoAutores($publicacion->autores));
				$table = $this->pintaLineaTabla($table, $this->styleLastTHRow, $this->styleLastTDRow, __('Data'), $publicacion->year);

			}
			// $section->addPageBreak();
		}
	}

	public function wordEquipoNuevo( $section, $request, $phpWord)
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
		if( !$equiposNuevos->isEmpty() ){

			$lang = \Session::get('locale');
			$lang = $request->lng ;
			
			// Tabla config
			$tableName     = __('Hornikuntza zientifikoaren eskurapena');
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
		}
	}

	public function wordEkintzakGizarteaObjeto()
	{
		$ekintzakGizartea = false;
		if(  $this->unico  ){
			$ekintzakGizartea = EkintzakGizartea::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('fecha','DESC')
			->get();
		}else{
			$ekintzakGizartea = EkintzakGizartea::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->orderBy('fecha','DESC')
			->get();
		}
		return $ekintzakGizartea;
	}
	public function wordEkintzakGizartea( $section, $request, $phpWord)
	{
		$ekintzakGizartea = $this->wordEkintzakGizarteaObjeto();
		if( !$ekintzakGizartea->isEmpty() ){
			
			$lang      = $request->lng ;
			$titulo    = "titulo_".$lang ;
			$desc      = "desc_".$lang ;
			$titCont   = "8.";
			$cont      = 1 ;
			foreach ($ekintzakGizartea as $ekintzaGizartea){
				$section->addText(  $titCont.$cont."-".$ekintzaGizartea->$titulo , $this->styleH1  );
				$section->addText(  __('Data').": ".$ekintzaGizartea->fecha , $this->styleP  );
				\PhpOffice\PhpWord\Shared\Html::addHtml($section, \App\Traits\Listados::limpiarAtributosHtml( ($ekintzaGizartea->$desc) ) );
				$cont =$cont + 1;
			}
		}
	}
	
	public function wordDivulgacionObjeto( $tipo )
	{
		$divulgaciones = false;
		if(  $this->unico  ){
			$divulgaciones = Divulgacion::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where('tipo',$tipo)
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('fecha','DESC')
			->get();
		}else{
			$divulgaciones = Divulgacion::whereBetween('fecha', array($this->fechaDesde, $this->fechaHasta))
			->where('tipo',$tipo)
			->orderBy('fecha','DESC')
			->get();
		}
		return $divulgaciones ;
	}
	public function wordDivulgacion( $section, $request, $tipo, $phpWord)
	{
		
		$divulgaciones = $this->wordDivulgacionObjeto($tipo);
		if( !$divulgaciones->isEmpty() ){
			if( $tipo == 'hedakuntza' ){
				$tituloH1 = __('Ekitaldiak') ;
			}else{
				$tituloH1 = __('Prentsa');
			}
			$lang      = \Session::get('locale');
			$lang      = $request->lng ;
		
			$cont      = 1 ;
			$titulo    = "titulo_".$lang;
			$desc      = "desc_".$lang;
		
			foreach ($divulgaciones as $divulgacion){
				if( $tipo == 'hedakuntza' ){
					$titCont   = "9.1";
					if($cont=='1'){
						$section->addText(  $titCont."-".__('Ekitaldiak') , $this->styleH1  );
					}
					$section->addText(  $titCont.".".$cont."-".$divulgacion->$titulo , $this->styleH2  );
					$section->addText(  __('Data').": ".$divulgacion->fecha , $this->styleP  );
					\PhpOffice\PhpWord\Shared\Html::addHtml($section, \App\Traits\Listados::limpiarAtributosHtml(($divulgacion->$desc) ) );
					$cont =$cont + 1;
				}else{
					$titCont   = "9.2";
						if($cont=='1'){
					$section->addText(  $titCont."-".__('Prentsa') , $this->styleH1  );
					}
					$section->addText(  $titCont.".".$cont."-".$divulgacion->$titulo , $this->styleH2  );
					$section->addText(  __('Data').": ".$divulgacion->fecha , $this->styleP  );
					$section->addText(  __('Komunikabidea').": ".$divulgacion->fecha , $this->styleP  );
					$section->addText(  __('komunikabideWeb').": ".$divulgacion->fecha , $this->styleP  );
					$cont =$cont + 1;
				}
			}
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
		$this->styleH          = array('name' => $this->fuente, 'size' => 20, 'bold' => true);
		$this->styleH1         = array('name' => $this->fuente, 'size' => 18, 'bold' => true);
		$this->styleH2         = array('name' => $this->fuente, 'size' => 15, 'bold' => true);
		$this->styleH3         = array('name' => $this->fuente, 'size' => 12, 'bold' => true);
		$this->styleP          = array('name' => $this->fuente, 'size' => 10, 'bold' => false);
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

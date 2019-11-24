<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoInvestigacion;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;
use App\Mail\Welcome as WelcomeEmail;
use Carbon\Carbon;
use App\GrupoInvestigacionParticipantes;
use App\GrupoInvestigacionResponsables;
use App\Lib\Functions;

class GrupoInvestigacionController extends Controller
{
    public function index()
    {
       $data = GrupoInvestigacion:: where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', GrupoInvestigacionParticipantes::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
                $query->orWhereIN('id', GrupoInvestigacionResponsables::where('id_autor', \Auth::user()->id_autor)->pluck('id_grupoInvestigacion'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
       return view('grupoInvestigacion.index',compact('data')) ;
    }

    public function indexAll()
    {
       $data = GrupoInvestigacion::where('id', '>', '0')->orderBy('id','DESC')->paginate(25);
       return view('grupoInvestigacion.index',compact('data')) ;
    }

    public function create()
    {
        return view('grupoInvestigacion.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'grupo_eu'     => 'required',
            'lineasInv_eu' => 'required',
            'desde'        => 'required'
        ],
        [
            'grupo_eu.required'        => __('Taldea beharrezkoa da.'),
            'lineasInv_eu.required'    => __('Ikerkuntza lerrorak beharrezkoa da.'),
            'desde.required'           => __('Noiztik beharrezkoa da.')
        ]);
        
        if($request->grupo_es==''){
             $request['grupo_es'] = $request->grupo_eu;
        }
        
        $request['lineasInv_eu'] = \App\Traits\Listados::limpiarAtributosHtml($request->lineasInv_eu);
		if($request->lineasInv_es==''){
			$request['lineasInv_es'] = $request['lineasInv_eu'];
		}else{
			$request['lineasInv_es'] = \App\Traits\Listados::limpiarAtributosHtml($request->lineasInv_es);
		}
		
        

        $input = $request->all();
        if(!$input['hasta']){ $input['hasta'] = null; }
        $grupoInvestigacion = GrupoInvestigacion::create($input);
        return view('grupoInvestigacion.edit',compact('grupoInvestigacion'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $grupoInvestigacion = GrupoInvestigacion::find($id);

        return view('grupoInvestigacion.edit',compact('grupoInvestigacion'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'grupo_eu' => 'required',
            'lineasInv_eu' => 'required',
            'desde'        => 'required'
        ],
        [
            'grupo_eu.required'        => __('Taldea beharrezkoa da.'),
            'lineasInv_eu.required'    => __('Ikerkuntza lerrorak beharrezkoa da.'),
            'desde.required'           => __('Noiztik beharrezkoa da.')
        ]);
        
        $request['lineasInv_eu'] = \App\Traits\Listados::limpiarAtributosHtml($request->lineasInv_eu);
		if($request->lineasInv_es==''){
			$request['lineasInv_es'] = $request['lineasInv_eu'];
		}else{
			$request['lineasInv_es'] = \App\Traits\Listados::limpiarAtributosHtml($request->lineasInv_es);
		}
		
        $input = $request->all();
        if(!$input['hasta']){ $input['hasta'] = null; }
        $grupoInvestigacion = GrupoInvestigacion::find($id);
        $grupoInvestigacion->update($input);
        return redirect()->route('grupoInvestigacion.index')->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        GrupoInvestigacion::find($id)->delete();
        return redirect()->route('grupoInvestigacion.index')
                        ->with('success', __('Zuzen ezabatu da'));
    }

private function crearSql($q, $request = false)
	{


		if(isset($request['grupo_eu'])) {
			if($request['grupo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('GrupoInvestigacion.grupo_eu', 'like', "%".trim($request['grupo_eu'])."%");
				});
			}
		}

		if(isset($request['grupo_es'])) {
			if($request['grupo_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('GrupoInvestigacion.grupo_es', 'like', "%".trim($request['grupo_es'])."%");
				});
			}
		}

		if(isset($request['lineasInv_eu'])) {
			if($request['lineasInv_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('GrupoInvestigacion.lineasInv_eu', 'like', "%".$request['lineasInv_eu']."%");
				});
			}
		}
		if(isset($request['lineasInv_es'])) {
			if($request['lineasInv_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('GrupoInvestigacion.lineasInv_es', 'like', "%".trim($request['lineasInv_es'])."%");
				});
			}
		}

        if(isset($request['desde']) and isset($request['hasta']) ) {
            if($request['desde'] != '' and $request['hasta'] != '') {
				$q->where(function ($query) use ($request)  {
                      $query->where('desde', '>=', $request['desde']);
                      $query->where('desde', '<=', $request['hasta']);
                      $query->orWhere('hasta', '>=', $request['desde']);
                      $query->where('hasta', '<=', $request['hasta']);
                      return $query;
				});

			}

		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    $idAutor = $request['id_autor'];
			    $q  = $q->whereHas('responsables', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}

        if(isset($request['id_autor2'])) {
			if($request['id_autor2'] != '') {
			    $idAutor = $request['id_autor2'];
			    $q  = $q->whereHas('participantes', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}
		return $q;
	}

    public function search(Request $request)
    {
        $q    = GrupoInvestigacion::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->orderBy('GrupoInvestigacion.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        $tipo = $request['tipo'];
        \Session::put('search', '1');
        return view('grupoInvestigacion.index',compact('data')) ;
    }

    public function enlazarParticipante($id, $id_autor)
    {
         $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
         $grupoInvestigacion->participantes()->attach($id_autor);
         return __("Erlazioa egin da");
    }
    public function enlazarResponsable($id, $id_autor)
    {
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
        $grupoInvestigacion->responsables()->attach($id_autor);
        return __("Erlazioa egin da");
    }

    public function detachParticipante($id, $id_autor)
    {
         $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
         $grupoInvestigacion->participantes()->detach($id_autor);
         return "id investigacion: ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
    public function detachResponsable($id, $id_autor)
    {
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
        $grupoInvestigacion->responsables()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }

    public function grupoInvestigacionAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('GrupoInvestigacion')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')
    			->take(10)
    			->get();
    		foreach ($queries as $query) {
    		    if(!in_array($query->id, $array)){
    			    $results[] = ['id' => $query->id, 'value' => $query->$nombre ];
    			    $array[] = $query->id;
    		   }
    		}
	    }
		return Response::json($results);
    }

    public function email(){
        $user =  \App\User::find(1);

        \Mail::to('email@styde.net', 'Styde.Net')
	        ->send(new WelcomeEmail($user));
	    return redirect()->route('grupoInvestigacion.index')
            ->with('success', __('Emaila zuzen bidali da'));
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
    public function word()
    {

        $gruposInvestigacion = GrupoInvestigacion::orderBy('id','DESC')->get();
        $lang = \Session::get('locale');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        //Indice
        $section = $this->indiceWord($phpWord);

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
                $responsable = false;
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
                $responsable = false;
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
}

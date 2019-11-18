<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramasDeIntercambio;
use App\ProgramasDeIntercambioProfesores;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Mail\Welcome as WelcomeEmail;
use App\Lib\Functions;

class ProgramasDeIntercambioController extends Controller
{
    public function index($tipo)
    {
       $data = ProgramasDeIntercambio::select('*','programasDeIntercambio.id as proId')
            ->where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', ProgramasDeIntercambioProfesores::where('id_autor', \Auth::user()->id_autor)->pluck('id_programaIntercambio'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
       return view('programasDeIntercambio.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
    {
       $data = ProgramasDeIntercambio::where('id', '>', '0')->where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
       return view('programasDeIntercambio.index',compact('data', 'tipo')) ;
    }

    public function create($tipo)
    {
       return view('programasDeIntercambio.create', compact('tipo'));
    }

    public function store(Request $request)
    {
          $this->validate($request, [
            'actividad_eu' => 'required',
            'lugar' => 'required',
            'desde' => 'required',
            'tipo' => 'required'
            ],
            [
                'actividad_eu.required'      => __('Aktibitatea  beharrezkoa da.'),
                'lugar.required'             => __('Tokia   beharrezkoa da.'),
                'desde.required'             => __('Noiztik  beharrezkoa da.')
            ]
            );
        if($request->actividad_es==''){
             $request['actividad_es'] = $request->actividad_eu;
        }
        if($request->hasta==''){
             $request['hasta'] = \Carbon\Carbon::now('Europe/Madrid');
        }
        $input = $request->all();
        $programaDeIntercambio = ProgramasDeIntercambio::create($input);
        return view('programasDeIntercambio.edit',compact('programaDeIntercambio'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $programaDeIntercambio = ProgramasDeIntercambio::find($id);
        return view('programasDeIntercambio.edit',compact('programaDeIntercambio'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'actividad_eu' => 'required',
            'lugar' => 'required',
            'desde' => 'required',
            'tipo' => 'required'
        ],
        [
            'actividad_eu.required'      => __('Aktibitatea  beharrezkoa da.'),
            'lugar.required'             => __('Tokia   beharrezkoa da.'),
            'desde.required'             => __('Noiztik  beharrezkoa da.')
        ]);
        if($request->actividad_es==''){
             $request['actividad_es'] = $request->actividad_eu;
        }
        if($request->hasta==''){
             $request['hasta'] = \Carbon\Carbon::now('Europe/Madrid');
        }
        $input       = $request->all();
        $programaDeIntercambio = ProgramasDeIntercambio::find($id);
        $programaDeIntercambio->update($input);
        $tipo          = $programaDeIntercambio->tipo;
        return redirect()->route('programasDeIntercambio.index', compact( 'tipo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo)
    {
        ProgramasDeIntercambio::find($id)->delete();
        //If admin
        //ProgramasDeIntercambio::find($id)->forceDelete();
        return redirect()->route('programasDeIntercambio.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));
    }

    private function crearSql($q, $request = false)
	{


		if(isset($request['actividad_eu'])) {
			if($request['actividad_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('programasDeIntercambio.actividad_eu', 'like', "%".trim($request['actividad_eu'])."%");
				});
			}
		}

		if(isset($request['actividad_es'])) {
			if($request['actividad_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('programasDeIntercambio.actividad_es', 'like', "%".trim($request['actividad_es'])."%");
				});
			}
		}


    	if(isset($request['lugar'])) {
			if($request['lugar'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('programasDeIntercambio.lugar', 'like', "%".trim($request['lugar'])."%");
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

        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('programasDeIntercambio.tipo', $request['tipo'] );
				});
			}
		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    $idAutor = $request['id_autor'];
			    $q  = $q->whereHas('profesores', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}


		return $q;
	}

    public function search(Request $request)
    {

        $q    = ProgramasDeIntercambio::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->select('*','programasDeIntercambio.id as proId')
                ->orderBy('programasDeIntercambio.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        // dd($sql );
        $tipo = $request['tipo'];
        \Session::put('search', '1');
        return view('programasDeIntercambio.index',compact('data', 'tipo')) ;
    }

    public function programasDeIntercambioAjax($nombre, $tipo){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('programasDeIntercambio')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')
    			->where('tipo', $tipo)
    			->take(10)
    			->get();
    		foreach ($queries as $query) {
    		    if(!in_array($query->id, $array)){
    			    $results[] = ['id' => $query->id, 'value' => $query->$nombre];
    			    $array[] = $query->id;
    		   }
    		}
	    }
		return Response::json($results);
    }

    public function enlazarProfesor($id, $id_autor)
    {
         $programaDeIntercambio = ProgramasDeIntercambio::findOrFail($id);
         $programaDeIntercambio->profesores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachProfesor($id, $id_autor)
    {
        $programaDeIntercambio = ProgramasDeIntercambio::findOrFail($id);
        $programaDeIntercambio->profesores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }

}

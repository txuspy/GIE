<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Congresos;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;
use App\CongresosProfesores;
use App\Lib\Functions;

class CongresosController extends Controller
{
    public function index()
    {
       $data = Congresos:: where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', CongresosProfesores::where('id_autor', \Auth::user()->id_autor)->pluck('id_congreso'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
       return view('congresos.index',compact('data')) ;
    }

    public function indexAll()
    {
       $data = Congresos::where('id', '>', '0')->orderBy('id','DESC')->paginate(25);
       return view('congresos.index',compact('data')) ;
    }

    public function create()
    {
        return view('congresos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'congreso_eu'       => 'required',
            'conferenciaPoster' => 'required',
            'ekarpena'          => 'required',
            'lugar'          => 'required',
            'desde'          => 'required',
            'hasta'          => 'required',
        ],
        [
            'congreso_eu.required'          => __('Kongresua  beharrezkoa da.'),
            'conferenciaPoster.required'    => __('Izenburua  beharrezkoa da.'),
            'lugar.required'                => __('Tokia  beharrezkoa da.'),
            'congreso_eu.required'          => __('Kongresua  beharrezkoa da.'),
            'desde.required'                => __('Noiztik beharrezkoa da.'),
            'hasta.required'                => __('Arte beharrezkoa da.')
        ]);


        $request['congreso_es'] = $request->congreso_eu;


        $input = $request->all();
        $congreso = Congresos::create($input);
        return view('congresos.edit',compact('congreso'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $congreso = Congresos::find($id);
        return view('congresos.edit',compact('congreso'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'congreso_eu'       => 'required',
            'conferenciaPoster' => 'required',
            'ekarpena'          => 'required',
            'lugar'             => 'required',
            'desde'             => 'required',
            'hasta'             => 'required',
        ],
        [
            'congreso_eu.required'          => __('Kongresua  beharrezkoa da.'),
            'conferenciaPoster.required'    => __('Izenburua  beharrezkoa da.'),
            'lugar.required'                => __('Tokia  beharrezkoa da.'),
            'congreso_eu.required'          => __('Kongresua  beharrezkoa da.'),
            'desde.required'                => __('Noiztik beharrezkoa da.'),
            'hasta.required'                => __('Arte beharrezkoa da.')
        ]);

        $request['congreso_es'] = $request->congreso_eu;
        $input = $request->all();

        $congreso = Congresos::find($id);
        $congreso->update($input);
        return redirect()->route('congresos.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        Congresos::find($id)->delete();
        return redirect()->route('congresos.index')
            ->with('success', __('Zuzen ezabatu da'));
    }


    private function crearSql($q, $request = false)
	{


		if(isset($request['conferenciaPoster'])) {
			if($request['conferenciaPoster'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('conferenciaPoster', 'like', "%".trim($request['conferenciaPoster'])."%");
				});
			}
		}

		if(isset($request['congreso_eu'])) {
			if($request['congreso_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('congreso_eu', 'like', "%".trim($request['congreso_eu'])."%");
				});
			}
		}

		if(isset($request['ekarpena'])) {
			if($request['ekarpena'] != '0') {
				$q->where(function ($query) use ($request) {
					return $query->where('ekarpena',  $request['ekarpena'] );
				});
			}
		}


    	if(isset($request['lugar'])) {
			if($request['lugar'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('lugar', 'like', "%".trim($request['lugar'])."%");
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
			    $q  = $q->whereHas('profesores', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}


		return $q;
	}

    public function search(Request $request)
    {
        // dd($request->all());
        $q    = Congresos::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->orderBy('id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        //  dd($sql );
        $tipo = $request['tipo'];
        \Session::put('search', '1');
        return view('congresos.index',compact('data')) ;
    }


    public function congresosAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('congresos')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')

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
         $congresos = Congresos::findOrFail($id);
         $congresos->profesores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachProfesor($id, $id_autor)
    {
         $grupoInvestigacion = Congresos::findOrFail($id);
         $grupoInvestigacion->profesores()->detach($id_autor);
         return "id : ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
}

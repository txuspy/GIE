<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquipamientoNuevo;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;
use App\Lib\Functions;

class EquipamientoNuevoController extends Controller
{
    public function index()
    {
        $data = EquipamientoNuevo:: where(function($query) {
                $query->where('user_id', \Auth::user()->id);

            })
            ->orderBy('id','DESC')
            ->paginate(25);
       return view('equipamientoNuevo.index',compact('data')) ;


    }

     public function indexAll()
    {
       $data = EquipamientoNuevo::where('id', '>', '0')->orderBy('id','DESC')->paginate(25);
       return view('equipamientoNuevo.index',compact('data')) ;
    }



    public function create()
    {
        return view('equipamientoNuevo.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'hornikuntza' => 'required',
            'ekipamendua' => 'required',
            'institucion' => 'required',
            'data' => 'required',
        ],
        [
            'hornikuntza.required'      => __('Hornikuntza  beharrezkoa da.'),
            'institucion.required'      => __('Instituzioa   beharrezkoa da.'),
            'data.required'             => __('Data  beharrezkoa da.')
        ]);
        /*if($request->equipo_es==''){
             $request['equipo_es'] = $request->hornikuntza;
        }*/
        $input = $request->all();
        if(!$input['data']){ $input['data'] = null; }
        $equipamientoNuevo = EquipamientoNuevo::create($input);
        return view('equipamientoNuevo.edit',compact('equipamientoNuevo'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $equipamientoNuevo = EquipamientoNuevo::find($id);
        return view('equipamientoNuevo.edit',compact('equipamientoNuevo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hornikuntza' => 'required',
            'ekipamendua' => 'required'
        ],
        [
            'hornikuntza.required'        => __('Hornikuntza  beharrezkoa da.'),
            'institucion.required'      => __('Instituzioa   beharrezkoa da.'),
            'data.required'             => __('Data  beharrezkoa da.')
        ]);
        $input = $request->all();
        if(!$input['data']){ $input['data'] = null; }
        $equipamientoNuevo = EquipamientoNuevo::find($id);
        $equipamientoNuevo->update($input);
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        EquipamientoNuevo::find($id)->delete();
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen ezabatu da'));
    }

     private function crearSql($q, $request = false)
	{


		if(isset($request['hornikuntza'])) {
			if($request['hornikuntza'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('hornikuntza', 'like', "%".trim( $request['hornikuntza'] )."%");
				});
			}
		}

		if(isset($request['ekipamendua'])) {
			if($request['ekipamendua'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('ekipamendua', 'like', "%".trim( $request['ekipamendua'] )."%");
				});
			}
		}

		if(isset($request['departamento'])) {
			if($request['departamento'] != '0') {
				$q->where(function ($query) use ($request) {
					return $query->where('departamento',  $request['departamento'] );
				});
			}
		}

		if(isset($request['importe'])) {
			if($request['importe'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('importe',  $request['importe'] );
				});
			}
		}

		if(isset($request['data'])) {
			if($request['data'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('data',  $request['data'] );
				});
			}
		}


    	if(isset($request['institucion'])) {
			if($request['institucion'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('institucion', 'like', "%".trim( $request['institucion'])."%");
				});
			}
		}



		return $q;
	}

    public function search(Request $request)
    {
        //dd($request->all());
        $q    = EquipamientoNuevo::query();
        $q    = $this->crearSql($q, $request);
        $data = $q
                ->orderBy('id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        //dd($sql );
        \Session::put('search', '1');

        $tipo = $request['tipo'];
        return view('equipamientoNuevo.index',compact('data')) ;
    }

    public function equipamientoNuevoAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('equipamientoNuevo')
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

}

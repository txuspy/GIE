<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postgrados;
use App\PostgradosAutores;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;

class PostgradosController extends Controller
{
    public function index($tipo)
    {

       $data = Postgrados::where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', PostgradosAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_postgrado'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);


       return view('postgrados.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
    {
       $data = Postgrados::where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
       return view('postgrados.index',compact('data', 'tipo')) ;
    }

    public function create($tipo)
    {
       return view('postgrados.create', compact('tipo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo_eu' => 'required',
            'curso_eu' => 'required',
            'departamento' => 'required',
            'tipo' => 'required',
            'duracion' => 'required',
            'lugar' => 'required',
            'fecha' => 'required',
        ],
        [
            'titulo_eu.required'    => __('Programa beharrezkoa da.'),
            'curso_eu.required'     => __('Ikastaroa beharrezkoa da.'),
            'departamento.required' => __('Saila beharrezkoa da.'),
            'duracion.required'     => __('Iraupena beharrezkoa da.'),
            'lugar.required'        => __('Tokia beharrezkoa da.'),
            'fecha.required'        => __('Data beharrezkoa da.')
        ]);




        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        if($request->curso_es==''){
             $request['curso_es'] = $request->curso_eu;
        }
        $input = $request->all();
        $postgrado = Postgrados::create($input);
        return view('postgrados.edit',compact('postgrado'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $postgrado = Postgrados::find($id);
        return view('postgrados.edit',compact('postgrado'));
    }

    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'titulo_eu' => 'required',
            'curso_eu' => 'required',
            'departamento' => 'required',
            'tipo' => 'required',
            'duracion' => 'required',
            'lugar' => 'required',
            'fecha' => 'required',
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        if($request->curso_es==''){
             $request['curso_es'] = $request->curso_eu;
        }
        $input       = $request->all();
        $postgrado = Postgrados::find($id);
        $postgrado->update($input);
        $tipo          = $postgrado->tipo;
        return redirect()->route('postgrados.index', compact( 'tipo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo)
    {
        Postgrados::find($id)->delete();
        return redirect()->route('postgrados.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));
    }

    private function crearSql($q, $request = false)
	{


		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.titulo_eu', 'like', "%".$request['titulo_eu']."%");
				});
			}
		}

		if(isset($request['curso_eu'])) {
			if($request['curso_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.curso_eu', 'like', "%".$request['curso_eu']."%");
				});
			}
		}

		if(isset($request['departamento'])) {
			if($request['departamento'] != '0' ) {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.departamento', $request['departamento']);
				});
			}
		}

	    if(isset($request['duracion'])) {
			if($request['duracion'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.duracion', $request['duracion'] );
				});
			}
		}

    	if(isset($request['lugar'])) {
			if($request['lugar'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.lugar', 'like', "%".$request['lugar']."%");
				});
			}
		}


        if(isset($request['fecha'])) {
			if($request['fecha'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.fecha', $request['fecha'] );
				});
			}
		}

        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('postgrados.tipo', $request['tipo'] );
				});
			}
		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    //dd( "Movida esto es una relacion attach: ".$request['id_autor'] );
			    $q->join('postgradosAutores', 'postgradosAutores.id_postgrado', '=', 'postgrados.id');
			    $q->where(function ($query) use ($request) {
					return $query->where('postgradosAutores.id_autor', $request['id_autor'] );
				});
			}
		}
		return $q;
	}

    public function search(Request $request)
    {
        $q    = Postgrados::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->orderBy('postgrados.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        $tipo = $request['tipo'];
        return view('postgrados.index' , compact('data', 'tipo')) ;
    }

    public function postgradosAjax($nombre, $tipo){

        $term = trim(Input::get('term'));

        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('postgrados')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')
    			->where('tipo', $tipo )
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


    public function enlazarAutores($id, $id_autor)
    {
         $postgrado = Postgrados::findOrFail($id);
         $postgrado->autores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachAutores($id, $id_autor)
    {
        $postgrado = Postgrados::findOrFail($id);
        $postgrado->autores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

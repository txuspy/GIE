<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formaciones;
use App\FormacionesAutores;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;


class FormacionesController extends Controller
{
    public function index($tipo, $modo)
    {

       $data = Formaciones::select('*','formaciones.id as forId')
            ->where('tipo', $tipo)
            ->where('modo', $modo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', FormacionesAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_formacion'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);

       return view('formaciones.index',compact('data', 'tipo', 'modo')) ;
    }

    public function indexAll($tipo, $modo)
    {
       $data = Formaciones::where('tipo',$tipo)->where('modo', $modo)->orderBy('id','DESC')->paginate(25);
       return view('formaciones.index',compact('data', 'tipo', 'modo')) ;
    }

    public function create($tipo, $modo)
    {
       return view('formaciones.create', compact('tipo', 'modo'));
    }

    public function store(Request $request)
    {


    	if( $request->modo == 'recibir' ){
    	     $this->validate($request, [
                'titulo_eu'      => 'required',
                'organizador_eu' => 'required',
                'tipo'           => 'required',
                'modo'           => 'required',
                'fecha'          => 'required',
            ],
            [
                'titulo_eu.required'      => __('Ikastaroa beharrezkoa da.'),
                'organizador_eu.required' => __('Antolatzailea(k) beharrezkoa da.'),
                'fecha.required'          => __('Data beharrezkoa da.')
            ]);
            if($request->organizador_es==''){
                 $request['organizador_es'] = $request->organizador_eu;
            }
    	}else{
    	     $this->validate($request, [
                'titulo_eu'      => 'required',
                'tipo'           => 'required',
                'modo'           => 'required',
                'fecha'          => 'required',
            ],
            [
                'titulo_eu.required'      => __('Ikastaroa beharrezkoa da.'),
                'fecha.required'          => __('Data beharrezkoa da.')
            ]);
    	}
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }

        $input = $request->all();
        $formacion = Formaciones::create($input);
        return view('formaciones.edit',compact('formacion'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $formacion = Formaciones::find($id);
        return view('formaciones.edit',compact('formacion'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo_eu'      => 'required',
            'tipo'           => 'required',
            'modo'           => 'required',
            'fecha'          => 'required',
        ],
        [
            'titulo_eu.required'      => __('Ikastaroa beharrezkoa da.'),
            'fecha.required'          => __('Data beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        if($request->organizador_es==''){
             $request['organizador_es'] = $request->organizador_eu;
        }
        $input       = $request->all();
        $formacion = Formaciones::find($id);
        $formacion->update($input);
        $tipo          = $formacion->tipo;
        $modo          = $formacion->modo;
        return redirect()->route('formaciones.index', compact( 'tipo', 'modo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo, $modo)
    {
        Formaciones::find($id)->delete();
        return redirect()->route('formaciones.index', compact( 'tipo', 'modo'))
            ->with('success', __('Zuzen ezabatu da'));
    }

    private function crearSql($q, $request = false)
	{


		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.titulo_eu', 'like', "%".$request['titulo_eu']."%");
				});
			}
		}

		if(isset($request['organizador_eu'])) {
			if($request['organizador_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.organizador_eu', 'like', "%".$request['organizador_eu']."%");
				});
			}
		}

		if(isset($request['organizador_es'])) {
			if($request['organizador_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.organizador_es', 'like', "%".$request['organizador_es']."%");
				});
			}
		}

	    if(isset($request['duracion'])) {
			if($request['duracion'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.duracion', $request['duracion'] );
				});
			}
		}

    	if(isset($request['lugar'])) {
			if($request['lugar'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.lugar', 'like', "%".$request['lugar']."%");
				});
			}
		}


        if(isset($request['fecha'])) {
			if($request['fecha'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.fecha', $request['fecha'] );
				});
			}
		}

        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.tipo', $request['tipo'] );
				});
			}
		}

        if(isset($request['modo'])) {
			if($request['modo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('formaciones.modo', $request['modo'] );
				});
			}
		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    $idAutor = $request['id_autor'];
			    $q  = $q->whereHas('autores', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}


		return $q;
	}

    public function search(Request $request)
    {

        $q    = Formaciones::query();
        $q    = $this->crearSql($q, $request);


        $data = $q->select('*','formaciones.id as forId')
                ->orderBy('formaciones.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        //dd($sql );
        $tipo = $request['tipo'];
        $modo = $request['modo'];
        return view('formaciones.index',compact('data', 'tipo', 'modo')) ;
    }

    public function formacionesAjax($nombre, $tipo, $modo){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('formaciones')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')
    			->where('tipo', $tipo)
                ->where('modo', $modo)
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
         $publicacion = Formaciones::findOrFail($id);
         $publicacion->autores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachAutores($id, $id_autor)
    {
        $publicacion = Formaciones::findOrFail($id);
        $publicacion->autores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

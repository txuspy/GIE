<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicaciones;
use App\PublicacionesAutores;
use App\Aldizkariak;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;
use Session;

class PublicacionesController extends Controller
{
    public function index($tipo)
    {
       $data = Publicaciones::where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', PublicacionesAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_publicacion'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);

       return view('publicaciones.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
    {
       $data = Publicaciones::where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
       return view('publicaciones.index',compact('data', 'tipo')) ;
    }

    public function create($tipo)
    {
       return view('publicaciones.create', compact('tipo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo_eu' => 'required',
            'tipo' => 'required',
            'year' => 'required',
        ],
        [
            'titulo_eu.required'    => __('Izenburua beharrezkoa da.'),
            'year.required'         => __('Data beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        if($request->editorialRevisa!=''){
            if($request->tipo=='articulos'){
                $aldizkaria = Aldizkariak::where('titulo', 'LIKE', '%' .$request->editorialRevisa. '%')
                    ->orWhere('corto', 'LIKE', '%' . $request->editorialRevisa. '%')
                    ->first();
                if($aldizkaria!=''){
                    $request['ISBN'] = $aldizkaria->ISSN;
                }
            }
        }

        $input = $request->all();
        $publicacion = Publicaciones::create($input);
        return view('publicaciones.edit',compact('publicacion'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $publicacion = Publicaciones::find($id);
        return view('publicaciones.edit',compact('publicacion'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'titulo_eu' => 'required',
            'tipo' => 'required',
            'year' => 'required',
        ],
        [
            'titulo_eu.required'    => __('Izenburua beharrezkoa da.'),
            'year.required'         => __('Data beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }

         if($request->editorialRevisa!=''){
            if($request->tipo=='articulos'){
                $aldizkaria = Aldizkariak::where('titulo', 'LIKE', '%' .$request->editorialRevisa. '%')
                    ->orWhere('corto', 'LIKE', '%' . $request->editorialRevisa. '%')
                    ->first();
                if($request->ISBN==''){
                    if(count($aldizkaria)){
                        $request['ISBN'] = $aldizkaria->ISSN;
                    }
                }
            }
        }
        $input       = $request->all();
        $publicacion = Publicaciones::find($id);
        $publicacion->update($input);
        $tipo          = $publicacion->tipo;
        return redirect()->route('publicaciones.index', compact( 'tipo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo)
    {
        Publicaciones::find($id)->delete();
        return redirect()->route('publicaciones.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));
    }
    private function crearSql($q, $request = false)
	{


		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('titulo_eu', 'like', "%".trim($request['titulo_eu'])."%");
				});
			}
		}

    	if(isset($request['editorialRevisa'])) {
			if($request['editorialRevisa'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('editorialRevisa', 'like', "%".trim($request['editorialRevisa'])."%");
				});
			}
		}

    	if(isset($request['capitulo'])) {
			if($request['capitulo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('capitulo', 'like', "%".trim($request['capitulo'])."%");
				});
			}
		}

    	if(isset($request['ISBN'])) {
			if($request['ISBN'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('ISBN', 'like', "%".trim($request['ISBN'])."%");
				});
			}
		}

    	if(isset($request['fecha'])) {
			if($request['fecha'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('fecha', 'like', "%".$request['fecha']."%");
				});
			}
		}



        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('tipo', $request['tipo'] );
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
        $q    = Publicaciones::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->orderBy('id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
        $tipo = $request['tipo'];
        \Session::put('search', '1');
        return view('publicaciones.index',compact('data', 'tipo')) ;
    }


    public function publicacionesAjax($nombre, $tipo){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('publicaciones')
    			->select('id', $nombre)
    			->where($nombre, 'LIKE', '%' . $term . '%')
                ->where('tipo',$tipo)
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

    public function aldizkariakAjax(){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('aldizkariak')
    			->select('id', 'titulo' )
    			->where('titulo', 'LIKE', '%' . $term . '%')
                ->orWhere('corto', 'LIKE', '%' . $term . '%')
    			->take(10)
    			->get();
    		foreach ($queries as $query) {
    		    if(!in_array($query->id, $array)){
    			    $results[] = ['id' => $query->titulo, 'value' => $query->titulo];
    			    $array[] = $query->id;
    		   }
    		}
	    }
		return Response::json($results);
    }

    public function enlazarAutores($id, $id_autor)
    {
         $publicacion = Publicaciones::findOrFail($id);
         $publicacion->autores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachAutores($id, $id_autor)
    {
        $publicacion = Publicaciones::findOrFail($id);
        $publicacion->autores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

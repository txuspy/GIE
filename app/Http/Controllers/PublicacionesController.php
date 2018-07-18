<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicaciones;
use App\PublicacionesAutores;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;


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
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
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
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
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

    public function publicacionesAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('publicaciones')
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

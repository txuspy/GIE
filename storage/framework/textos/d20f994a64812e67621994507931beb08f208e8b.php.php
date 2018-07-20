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

class ProgramasDeIntercambioController extends Controller
{
    public function index($tipo)
    {
       $data = ProgramasDeIntercambio::where('tipo',$tipo)
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
       $data = ProgramasDeIntercambio::where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
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
        ]);
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

    public function programasDeIntercambioAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('programasDeIntercambio')
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

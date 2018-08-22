<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TesisDoctorales;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\TesisDoctoralesDirectores;
use App\TesisDoctoralesDoctorando;
use App\Departamentos;

class TesisDoctoralesController extends Controller
{
    public function index($tipo)
    {
       $data = TesisDoctorales::where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', TesisDoctoralesDirectores::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
                $query->orWhereIN('id', TesisDoctoralesDoctorando::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
        return view('tesisDoctorales.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
    {
       $data = TesisDoctorales::where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
       return view('tesisDoctorales.index',compact('data', 'tipo')) ;
    }

    public function create($tipo)
    {
       return view('tesisDoctorales.create', compact('tipo'));
    }

    public function store(Request $request)
    {
          $this->validate($request, [
            'titulo_eu'    => 'required',
            'departamento' => 'required',
            'fechaLectura' => 'required',
            'tipo'         => 'required'
        ],
        [
            'titulo_eu.required'           => __('Izenburua  beharrezkoa da.'),
            'fechaLectura.required'        => __('Data beharrezkoa da.')
        ]);
        $departamento = Departamentos::find($request->departamento);
        $request['fechaLectura'] = Carbon::now('Europe/Madrid');

        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        $input = $request->all();

        $tesisDoctoral = TesisDoctorales::create($input);
        return view('tesisDoctorales.edit',compact('tesisDoctoral'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tesisDoctoral = TesisDoctorales::find($id);
        return view('tesisDoctorales.edit',compact('tesisDoctoral'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo_es' => 'required',
            'tipo' => 'required',
            'fechaLectura' => 'required'
        ],
        [
            'titulo_eu.required'           => __('Izenburua  beharrezkoa da.'),
            'fechaLectura.required'        => __('Data beharrezkoa da.')
        ]);
        $input         = $request->all();
        $tesisDoctoral = TesisDoctorales::find($id);
        $tesisDoctoral->update($input);
        $tipo          = $tesisDoctoral->tipo;
        return redirect()->route('tesisDoctorales.index', compact('tipo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo)
    {
        TesisDoctorales::find($id)->delete();
        return redirect()->route('tesisDoctorales.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));

    }

    public function tesisDoctoralesAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('tesisDoctorales')
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


    public function enlazarDoctorando($id, $id_autor)
    {
         $grupoInvestigacion = TesisDoctorales::findOrFail($id);
         $grupoInvestigacion->doctorandos()->attach($id_autor);
         return __("Erlazioa egin da");
    }
    public function enlazarDirector($id, $id_autor)
    {
        $grupoInvestigacion = TesisDoctorales::findOrFail($id);
        $grupoInvestigacion->directores()->attach($id_autor);
        return __("Erlazioa egin da");
    }

    public function detachDoctorando($id, $id_autor)
    {
         $grupoInvestigacion = TesisDoctorales::findOrFail($id);
         $grupoInvestigacion->doctorandos()->detach($id_autor);
         return "id investigacion: ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
    public function detachDirector($id, $id_autor)
    {
        $grupoInvestigacion = TesisDoctorales::findOrFail($id);
        $grupoInvestigacion->directores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

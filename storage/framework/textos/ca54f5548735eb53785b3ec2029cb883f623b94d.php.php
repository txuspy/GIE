<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyectos;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Autor;
use App\ProyectosInvestigadores;
use App\ProyectosDirectores;


class ProyectosController extends Controller
{
    public function index($tipo)
    {
        $data = Proyectos::where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', ProyectosInvestigadores::where('id_autor', \Auth::user()->id_autor)->pluck('id_proyecto'));
                $query->orWhereIN('id', ProyectosDirectores::where('id_autor', \Auth::user()->id_autor)->pluck('id_proyecto'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
        return view('proyectos.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
    {
        $data = Proyectos::where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
        return view('proyectos.index',compact('data', 'tipo')) ;
    }


    public function create($tipo)
    {
       return view('proyectos.create', compact('tipo'));
    }

    public function store(Request $request)
    {
          $this->validate($request, [
            'proyecto_eu' => 'required',
            'tipo' => 'required',
            'desde' => 'required',
        ]);
        if($request->proyecto_es==''){
             $request['proyecto_es'] = $request->proyecto_eu;
        }
        if($request->hasta==''){
             $request['hasta'] = \Carbon\Carbon::now('Europe/Madrid');
        }
        $input    = $request->all();
        $proyecto = Proyectos::create($input);
        $fecha1   = \Carbon\Carbon::parse($proyecto->desde);
        $fecha2   = \Carbon\Carbon::parse($proyecto->hasta);
        $format   = $fecha2->diffInYears($fecha1) > 0 ? '%y '.__('urte').' , %m '.__('hilabete').',  %d '.__('egun'): '%m '.__('hilabete').',  %d '.__('egun');
        $periodo  = $fecha2->diff($fecha1)->format($format );
        return view('proyectos.edit',compact('proyecto', 'periodo'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $proyecto = Proyectos::find($id);
        $fecha1 = \Carbon\Carbon::parse($proyecto->desde);
        $fecha2 = \Carbon\Carbon::parse($proyecto->hasta);
        $format = $fecha2->diffInYears($fecha1) > 0 ? '%y '.__('urte').' , %m '.__('hilabete').',  %d '.__('egun'): '%m '.__('hilabete').',  %d '.__('egun');
        $periodo = $fecha2->diff($fecha1)->format($format );
        return view('proyectos.edit',compact('proyecto', 'periodo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'proyecto_es' => 'required',
            'tipo' => 'required'
        ]);
        $input         = $request->all();
        $proyecto = Proyectos::find($id);
        $proyecto->update($input);
        $tipo          = $proyecto->tipo;
        return redirect()->route('proyectos.index', compact( 'tipo'))
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id, $tipo)
    {
        Proyectos::find($id)->delete();
        //If admin
        //Proyectos::find($id)->forceDelete();
        return redirect()->route('proyectos.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));
    }

    public function proyectosAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('proyectoInvestigacion')
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
    public function enlazarInvestigador($id, $id_autor)
    {
         $grupoInvestigacion = Proyectos::findOrFail($id);
         $grupoInvestigacion->investigadores()->attach($id_autor);
         return __("Erlazioa egin da");
    }
    public function enlazarDirector($id, $id_autor)
    {
        $grupoInvestigacion = Proyectos::findOrFail($id);
        $grupoInvestigacion->directores()->attach($id_autor);
        return __("Erlazioa egin da");
    }

    public function detachInvestigador($id, $id_autor)
    {
         $grupoInvestigacion = Proyectos::findOrFail($id);
         $grupoInvestigacion->investigadores()->detach($id_autor);
         return "id investigacion: ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
    public function detachDirector($id, $id_autor)
    {
        $grupoInvestigacion = Proyectos::findOrFail($id);
        $grupoInvestigacion->directores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

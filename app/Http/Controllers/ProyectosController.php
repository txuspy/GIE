<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyectos;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;


class ProyectosController extends Controller
{
    public function index($tipo)
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
            'proyecto_es' => 'required',
            'tipo' => 'required'
        ]);
        $request['desde'] = Carbon::now('Europe/Madrid');
        $request['hasta'] = Carbon::now('Europe/Madrid');
        $input = $request->all();

        $proyecto = Proyectos::create($input);
        return view('proyectos.edit',compact('proyecto'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $proyecto = Proyectos::find($id);
        return view('proyectos.edit',compact('proyecto'));
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

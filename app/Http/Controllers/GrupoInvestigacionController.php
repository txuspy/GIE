<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoInvestigacion;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;

class GrupoInvestigacionController extends Controller
{
    public function index()
    {
       $data = GrupoInvestigacion::orderBy('id','DESC')->paginate(25);
       return view('grupoInvestigacion.index',compact('data')) ;
    }

    public function create()
    {
        return view('grupoInvestigacion.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'grupo_es' => 'required',
            'lineasInv_es' => 'required'
        ]);
        $input = $request->all();
        $grupoInvestigacion = GrupoInvestigacion::create($input);
        //return redirect()->route('grupoInvestigacion.index')
                       // ->with('success', __('Zuzen sortu da'));
        return view('grupoInvestigacion.edit',compact('grupoInvestigacion'))
                    ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $grupoInvestigacion = GrupoInvestigacion::find($id);
        return view('grupoInvestigacion.edit',compact('grupoInvestigacion'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'grupo_es' => 'required',
            'lineasInv_es' => 'required'
        ]);
        $input = $request->all();
        $grupoInvestigacion = GrupoInvestigacion::find($id);
        $grupoInvestigacion->update($input);
        return redirect()->route('grupoInvestigacion.index')->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        GrupoInvestigacion::find($id)->delete();
        return redirect()->route('grupoInvestigacion.index')
                        ->with('success', __('Zuzen ezabatu da'));
    }

    public function enlazarParticipante($id, $id_autor)
    {
         $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
         $grupoInvestigacion->participantes()->attach($id_autor);
         return __("Erlazioa egin da");
    }
    public function enlazarResponsable($id, $id_autor)
    {
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
        $grupoInvestigacion->responsables()->attach($id_autor);
        return __("Erlazioa egin da");
    }

    public function detachParticipante($id, $id_autor)
    {
         $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
         $grupoInvestigacion->participantes()->detach($id_autor);
         return "id investigacion: ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
    public function detachResponsable($id, $id_autor)
    {
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
        $grupoInvestigacion->responsables()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }

}

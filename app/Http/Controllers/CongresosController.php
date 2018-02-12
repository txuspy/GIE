<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Congresos;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;

class CongresosController extends Controller
{
    public function index()
    {
       $data = Congresos::orderBy('id','DESC')->paginate(25);
       return view('congresos.index',compact('data')) ;
    }

    public function create()
    {
        return view('congresos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'congreso_es' => 'required',
            'conferenciaPoster' => 'required'
        ]);
        $input = $request->all();
        $congreso = Congresos::create($input);
        return view('congresos.edit',compact('congreso'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $congreso = Congresos::find($id);
        return view('congresos.edit',compact('congreso'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'congreso_es' => 'required',
            'conferenciaPoster' => 'required'
        ]);
        $input = $request->all();
        $congreso = Congresos::find($id);
        $congreso->update($input);
        return redirect()->route('congresos.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        Congresos::find($id)->delete();
        return redirect()->route('congresos.index')
            ->with('success', __('Zuzen ezabatu da'));
    }

    public function enlazarProfesor($id, $id_autor)
    {
         $congresos = Congresos::findOrFail($id);
         $congresos->profesores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachProfesor($id, $id_autor)
    {
         $grupoInvestigacion = Congresos::findOrFail($id);
         $grupoInvestigacion->profesores()->detach($id_autor);
         return "id : ".$id." ,  id autor: ".$id_autor;
         return __("Erlazioa borratu egin da");
    }
}

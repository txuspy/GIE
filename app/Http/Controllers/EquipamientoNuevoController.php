<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquipamientoNuevo;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;

class EquipamientoNuevoController extends Controller
{
    public function index()
    {
       $data = EquipamientoNuevo::orderBy('id','DESC')->paginate(25);
       return view('equipamientoNuevo.index',compact('data')) ;
    }

    public function create()
    {
        return view('equipamientoNuevo.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'equipo_es' => 'required',
            'departamento_es' => 'required'
        ]);
        $input = $request->all();
        $equipamientoNuevo = EquipamientoNuevo::create($input);
        return view('equipamientoNuevo.edit',compact('equipamientoNuevo'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $equipamientoNuevo = EquipamientoNuevo::find($id);
        return view('equipamientoNuevo.edit',compact('equipamientoNuevo'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'equipo_es' => 'required',
            'departamento_es' => 'required'
        ]);
        $input = $request->all();
        $equipamientoNuevo = EquipamientoNuevo::find($id);
        $equipamientoNuevo->update($input);
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        EquipamientoNuevo::find($id)->delete();
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen ezabatu da'));
    }


}

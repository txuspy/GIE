<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramasDeIntercambio;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;


class ProgramasDeIntercambioController extends Controller
{
    public function index($tipo)
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
            'tipo' => 'required'
        ]);
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
            'titulo_eu' => 'required',
            'tipo' => 'required'
        ]);
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

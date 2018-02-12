<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publicaciones;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;


class PublicacionesController extends Controller
{
    public function index($tipo)
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
            'tipo' => 'required'
        ]);
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
            'tipo' => 'required'
        ]);
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
        //If admin
        //Publicaciones::find($id)->forceDelete();
        return redirect()->route('publicaciones.index', compact( 'tipo'))
            ->with('success', __('Zuzen ezabatu da'));
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

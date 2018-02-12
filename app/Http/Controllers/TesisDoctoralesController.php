<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TesisDoctorales;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;


class TesisDoctoralesController extends Controller
{
    public function index($tipo)
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
            'titulo_es' => 'required',
            'tipo' => 'required'
        ]);
        $request['fechaLectura'] = Carbon::now('Europe/Madrid');
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
            'tipo' => 'required'
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

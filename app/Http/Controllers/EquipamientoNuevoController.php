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
        $data = EquipamientoNuevo::where('id','>=','1')
           ->orderBy('id','DESC')
           ->paginate(25);
       return view('equipamientoNuevo.index',compact('data')) ;


    }

    public function create()
    {
        return view('equipamientoNuevo.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'equipo_eu' => 'required',
            'departamento' => 'required',
            'institucion' => 'required',
            'data' => 'required',
        ],
        [
            'equipo_eu.required'        => __('Hornikuntza  beharrezkoa da.'),
            'institucion.required'      => __('Instituzioa   beharrezkoa da.'),
            'data.required'             => __('Data  beharrezkoa da.')
        ]);
        if($request->equipo_es==''){
             $request['equipo_es'] = $request->equipo_eu;
        }
        $input = $request->all();
        if(!$input['data']){ $input['data'] = null; }
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
            'departamento' => 'required'
        ],
        [
            'equipo_eu.required'        => __('Hornikuntza  beharrezkoa da.'),
            'institucion.required'      => __('Instituzioa   beharrezkoa da.'),
            'data.required'             => __('Data  beharrezkoa da.')
        ]);
        $input = $request->all();
        if(!$input['data']){ $input['data'] = null; }
        $equipamientoNuevo = EquipamientoNuevo::find($id);
        $equipamientoNuevo->update($input);
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function equipamientoNuevoAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('equipamientoNuevo')
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

    public function destroy($id)
    {
        EquipamientoNuevo::find($id)->delete();
        return redirect()->route('equipamientoNuevo.index')
            ->with('success', __('Zuzen ezabatu da'));
    }


}

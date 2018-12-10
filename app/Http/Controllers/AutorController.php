<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use App\Autor;
use App\GrupoInvestigacion;

class AutorController extends Controller
{
    public function index()
    {
        $data = Autor::orderBy('apellido','ASC')->paginate(25);
        return view('autor.index',compact('data')) ;
    }

    public function create($valores)
    {

    }

    public function store(Request $request)
    {
        $valores = [
           'nombre'    => trim($request->nombreDialog),
           'apellido'  => trim($request->apellidoDialog),
        ];
        $autor = Autor::create($valores);
        return redirect()->back()->with('success', __('Zuzen sortu da'));
    }

    public function storeAjax(Request $request)
    {
        $valores = [
           'nombre'    => trim($request->nombreDialog),
           'apellido'  => trim($request->apellidoDialog),
        ];
        $autor = Autor::create($valores);
        return $autor;
    }

    public function autoresAjax(){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('autores')
    			->select('id', 'nombre','apellido')
    			->where('nombre', 'LIKE', '%' . $term . '%')
    			->Orwhere('apellido', 'LIKE', '%' . $term . '%')
    			->take(10)
    			->get();
    		foreach ($queries as $query) {
    		    if(!in_array($query->id, $array)){
    			    $results[] = ['id' => $query->id, 'value' => $query->nombre." ".$query->apellido];
    			    $array[] = $query->id;
    		   }
    		}
	    }
		return Response::json($results);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $autor = Autor::find($id);
        return view('autor.edit',compact('autor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required'
        ]);
        $valores = [
           'nombre'    => trim($request->nombre)),
           'aellido'  => trim($request->apellido))
        ];
        //$input = $request->all();
        $autor = Autor::find($id);
        $autor->update($valores);
        return redirect()->route('autor.index')->with('success', _('Zuzen aldatatu da') );
    }

    public function destroy($id)
    {
        Autor::find($id)->delete();
        return redirect()->route('autor.index')
            ->with('success', __('Zuzen ezabatu da'));
    }
}

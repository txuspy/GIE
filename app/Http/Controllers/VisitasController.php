<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitas;
use App\VisitasAutores;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;

class VisitasController extends Controller
{
    public function index()
    {
       $data = Visitas::where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', VisitasAutores::where('id_autor', \Auth::user()->id_autor)->pluck('id_visita'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);

       return view('visitas.index',compact('data')) ;
    }

    public function indexAll()
    {
       $data = Visitas::where('id', '>', '0')->orderBy('id','DESC')->paginate(25);
       return view('visitas.index',compact('data')) ;
    }

    public function create()
    {
       return view('visitas.create' );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo_eu' => 'required',
            'lugar' => 'required',
            'fecha' => 'required',
        ],
        [
            'titulo_eu.required'      => __('Aktibitatea  beharrezkoa da.'),
            'lugar.required'          => __('Tokia   beharrezkoa da.'),
            'fecha.required'          => __('Data  beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        $input = $request->all();
        $visita = Visitas::create($input);
        return view('visitas.edit',compact('visita'))
            ->with('success', __('Zuzen sortu da'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $visita = Visitas::find($id);
        return view('visitas.edit',compact('visita'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo_eu' => 'required',
            'lugar' => 'required',
            'fecha' => 'required',
        ],
        [
            'titulo_eu.required'      => __('Aktibitatea  beharrezkoa da.'),
            'lugar.required'          => __('Tokia   beharrezkoa da.'),
            'fecha.required'          => __('Data  beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        $input       = $request->all();
        $visita = Visitas::find($id);
        $visita->update($input);

        return redirect()->route('visitas.index')
            ->with('success', __('Zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        Visitas::find($id)->delete();
        return redirect()->route('visitas.index')
            ->with('success', __('Zuzen ezabatu da'));
    }


 private function crearSql($q, $request = false)
	{


		if(isset($request['actividad_eu'])) {
			if($request['actividad_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('visitas.actividad_eu', 'like', "%".$request['actividad_eu']."%");
				});
			}
		}

		if(isset($request['actividad_es'])) {
			if($request['actividad_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('visitas.actividad_es', 'like', "%".$request['actividad_es']."%");
				});
			}
		}


    	if(isset($request['lugar'])) {
			if($request['lugar'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('visitas.lugar', 'like', "%".$request['lugar']."%");
				});
			}
		}


        if(isset($request['desde'])) {
			if($request['desde'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('visitas.desde', $request['desde'] );
				});
			}
		}

        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('visitas.tipo', $request['tipo'] );
				});
			}
		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    $idAutor = $request['id_autor'];
			    $q  = $q->whereHas('autores', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}


		return $q;
	}

    public function search(Request $request)
    {

        $q    = Visitas::query();
        $q    = $this->crearSql($q, $request);
        $data = $q
                ->orderBy('visitas.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
       // dd($sql );
        $tipo = $request['tipo'];

         return view('visitas.index',compact('data')) ;
    }

    public function visitasAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('visitas')
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

    public function enlazarAutores($id, $id_autor)
    {
         $visita = Visitas::findOrFail($id);
         $visita->autores()->attach($id_autor);
         return __("Erlazioa egin da");
    }

    public function detachAutores($id, $id_autor)
    {
        $visita = Visitas::findOrFail($id);
        $visita->autores()->detach($id_autor);
        return __("Erlazioa borratu egin da");
    }
}

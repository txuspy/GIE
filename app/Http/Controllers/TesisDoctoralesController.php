<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TesisDoctorales;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\TesisDoctoralesDirectores;
use App\TesisDoctoralesDoctorando;
use App\Departamentos;
use App\Lib\Functions;

class TesisDoctoralesController extends Controller
{
    public function index($tipo)
    {
       $data = TesisDoctorales::where('tipo',$tipo)
            ->where(function($query) {
                $query->where('user_id', \Auth::user()->id);
                $query->orWhereIN('id', TesisDoctoralesDirectores::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
                $query->orWhereIN('id', TesisDoctoralesDoctorando::where('id_autor', \Auth::user()->id_autor)->pluck('id_tesisDoctoral'));
            })
            ->orderBy('id','DESC')
            ->paginate(25);
        return view('tesisDoctorales.index',compact('data', 'tipo')) ;
    }

    public function indexAll($tipo)
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
            'titulo_eu'    => 'required',
            'departamento' => 'required',
            'fechaLectura' => 'required',
            'tipo'         => 'required'
        ],
        [
            'titulo_eu.required'           => __('Izenburua  beharrezkoa da.'),
            'fechaLectura.required'        => __('Data beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }


        $departamento = Departamentos::find($request->departamento);
       // $request['fechaLectura'] = Carbon::now('Europe/Madrid');

        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
        $input = $request->all();

        $tesisDoctoral = TesisDoctorales::create($input);
        //dd($tesisDoctoral );
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
            'titulo_eu' => 'required',
            'tipo' => 'required',
            'fechaLectura' => 'required'
        ],
        [
            'titulo_eu.required'           => __('Izenburua  beharrezkoa da.'),
            'fechaLectura.required'        => __('Data beharrezkoa da.')
        ]);
        if($request->titulo_es==''){
             $request['titulo_es'] = $request->titulo_eu;
        }
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

    private function crearSql($q, $request = false)
	{


		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('titulo_eu', 'like', "%".$request['titulo_eu']."%");
				});
			}
		}

		if(isset($request['departamento'])) {
			if($request['departamento'] != '0' ) {
				$q->where(function ($query) use ($request) {
					return $query->where('departamento', $request['departamento']);
				});
			}
		}

		if(isset($request['euskera'])) {
			if($request['euskera'] != '0' ) {
				$q->where(function ($query) use ($request) {
					return $query->where('euskera', $request['euskera']);
				});
			}
		}

		if(isset($request['internacional'])) {
			if($request['internacional'] != '0' ) {
				$q->where(function ($query) use ($request) {
					return $query->where('internacional', $request['internacional']);
				});
			}
		}

		if(isset($request['fechaLectura'])) {
			if($request['fechaLectura'] != '' ) {
				$q->where(function ($query) use ($request) {
					return $query->where('fechaLectura', $request['fechaLectura']);
				});
			}
		}

        if(isset($request['tipo'])) {
			if($request['tipo'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('tipo', $request['tipo'] );
				});
			}
		}

        if(isset($request['id_autor'])) {
			if($request['id_autor'] != '') {
			    $idAutor = $request['id_autor'];
			    $q  = $q->whereHas('directores', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}

        if(isset($request['id_autor2'])) {
			if($request['id_autor2'] != '') {
			    $idAutor = $request['id_autor2'];
			    $q  = $q->whereHas('doctorandos', function ($q) use (  $idAutor ) {
                    $q->where('id_autor',  $idAutor );
                });
			}
		}
		return $q;
	}

    public function search(Request $request)
    {
        // dd($request->all());
        $q    = TesisDoctorales::query();
        $q    = $this->crearSql($q, $request);
        $data = $q->orderBy('tesisDoctorales.id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());

        // dd($sql );
        $tipo = $request['tipo'];

        return view('tesisDoctorales.index',compact('data', 'tipo')) ;
    }

    public function tesisDoctoralesAjax($nombre){
        $term = trim(Input::get('term'));
        $terminos = explode(' ', trim($term) );
        $results = array();
        $array=[];
        foreach ( $terminos as $term){
	       	$queries = DB::table('tesisDoctorales')
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

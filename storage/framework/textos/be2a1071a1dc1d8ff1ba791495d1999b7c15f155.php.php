<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EkintzakGizartea;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;


class EkintzakGizarteaController extends Controller
{
	public function index($tipo)
	{
		$data = EkintzakGizartea::where('tipo',$tipo)
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('id','DESC')
			->paginate(25);
		return view('ekintzakGizartea.index',compact('data', 'tipo')) ;
	}

	public function indexAll($tipo)
	{
		$data = EkintzakGizartea::where('id', '>', '0')->where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
		return view('ekintzakGizartea.index',compact('data', 'tipo')) ;
	}

	public function create($tipo)
	{
		return view('ekintzakGizartea.create', compact('tipo'));
	}

	public function store(Request $request)
	{
		
		$this->validate($request, [
			'tipo'        => 'required',
			'titulo_eu'   => 'required',
			'desc_eu'     => 'required'
		],
		[
			'titulo_eu.required'      => __('Izenburua  beharrezkoa da.'),
			'desc_eu.required'        => __('Deskripzioa beharrezkoa da.')
		]);
		if($request->titulo_es==''){
			$request['titulo_es'] = $request->titulo_eu;
		}
		$request['desc_eu'] = \App\Traits\Listados::limpiarAtributosHtml($request->desc_eu);
		if($request->desc_es==''){
			$request['desc_es'] = $request['desc_eu'];
		}else{
			$request['desc_es'] = \App\Traits\Listados::limpiarAtributosHtml($request->desc_es);
		}
		if($request->fecha==''){
			$request['fecha'] = \Carbon\Carbon::now('Europe/Madrid');
		}
		$input    = $request->all();
		$tipo = $request->tipo;
		$EkintzakGizartea = EkintzakGizartea::create($input);
		
		$data = EkintzakGizartea::where('tipo',	$tipo )
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('id','DESC')
			->paginate(25);
		return view('ekintzakGizartea.index',compact('data', 'tipo')) ;
		/*
		return view('ekintzakGizartea.index',compact('EkintzakGizartea'))
			->with('success', __('Zuzen sortu da'));
		*/
	
		//return view('ekintzakGizartea.edit',compact('EkintzakGizartea'))
		//	->with('success', __('Zuzen sortu da'));
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$ekintzaGizartea= EkintzakGizartea::find($id);
		return view('ekintzakGizartea.edit',compact('ekintzaGizartea'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'tipo'        => 'required',
			'titulo_eu'   => 'required',
			'desc_eu'     => 'required'
		],
		[
			'titulo_eu.required'      => __('Izenburua  beharrezkoa da.'),
			'desc_eu.required'        => __('Deskripzioa beharrezkoa da.')
		]);
		if($request->titulo_es==''){
			$request['titulo_es'] = $request->titulo_eu;
		}
		$request['desc_eu'] = \App\Traits\Listados::limpiarAtributosHtml($request->desc_eu);
		if($request->desc_es==''){
			$request['desc_es'] = $request['desc_eu'];
		}else{
			$request['desc_es'] = \App\Traits\Listados::limpiarAtributosHtml($request->desc_es);
		}
		if($request->fecha==''){
			$request['fecha'] = \Carbon\Carbon::now('Europe/Madrid');
		}
		$input       = $request->all();
		$ekintza    = EkintzakGizartea::find($id);
		$ekintza->update($input);
		$tipo        = $ekintza->tipo;
		return redirect()->route('ekintzakGizartea.index', compact( 'tipo'))
			->with('success', __('Zuzen aldatatu da'));
	}

	public function destroy($id, $tipo)
	{
		EkintzakGizartea::find($id)->delete();
		return redirect()->route('ekintzakGizartea.index', compact('tipo'))
			->with('success', __('Zuzen ezabatu da'));
	}

	private function crearSql($q, $request = false)
	{
		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('titulo_eu', 'like', "%".trim( $request['titulo_eu'] )."%");
				});
			}
		}
		if(isset($request['titulo_es'])) {
			if($request['titulo_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('titulo_es', 'like', "%".trim( $request['titulo_es'] )."%");
				});
			}
		}
		if(isset($request['desc_eu'])) {
			if($request['desc_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('desc_eu', 'like', "%".trim( $request['desc_eu'] )."%");
				});
			}
		}
		if(isset($request['desc_es'])) {
			if($request['desc_es'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('desc_es', 'like', "%".trim( $request['desc_es'] )."%");
				});
			}
		}
		if(isset($request['desde']) and isset($request['hasta']) ) {
			if($request['desde'] != '' and $request['hasta'] != '') {
				$q->where(function ($query) use ($request)  {
					  $query->where('fecha', '>=', $request['desde']);
					  $query->where('fecha', '<=', $request['hasta']);
					  return $query;
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

		return $q;
	}

	public function search(Request $request)
	{
		$q    = EkintzakGizartea::query();
		$q    = $this->crearSql($q, $request);
		$data = $q->orderBy('id','DESC')
				->paginate(25);
		$sql  = Functions::getSql($q, $q->toSql());
		$tipo = $request['tipo'];
		\Session::put('search', '1');
		return view('ekintzakGizartea.index',compact('data', 'tipo')) ;
	}

}

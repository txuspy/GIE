<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EkintzakAurretik;
use Illuminate\Support\Facades\Input;
use DB;
use Response;
use Carbon\Carbon;
use App\Lib\Functions;
use Session;


class EkintzakAurretikController extends Controller
{
	public function index($tipo)
	{
		$data = EkintzakAurretik::where('tipo',$tipo)
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('id','DESC')
			->paginate(25);
		return view('ekintzakAurretik.index',compact('data', 'tipo')) ;
	}

	public function indexAll($tipo)
	{
		$data = EkintzakAurretik::where('id', '>', '0')->where('tipo',$tipo)->orderBy('id','DESC')->paginate(25);
		return view('ekintzakAurretik.index',compact('data', 'tipo')) ;
	}

	public function create($tipo)
	{
		return view('ekintzakAurretik.create', compact('tipo'));
	}

	public function store(Request $request)
	{
		//dd($request->tipo);
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
		
		$input = $request->all();
		$tipo  = $request->tipo;
		$ekintzakAurretik = EkintzakAurretik::create($input);
		$data = EkintzakAurretik::where('tipo',$tipo)
			->where(function($query) {
				$query->where('user_id', \Auth::user()->id);
			})
			->orderBy('id','DESC')
			->paginate(25);
		return view('ekintzakAurretik.index',compact( 'data', 'tipo'))
			->with('success', __('Zuzen sortu da'));
		//return view('ekintzakAurretik.edit',compact('ekintzakAurretik'))
		//	->with('success', __('Zuzen sortu da'));
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$ekintzakAurretik= EkintzakAurretik::find($id);
		return view('ekintzakAurretik.edit',compact('ekintzakAurretik'));
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
		//dd($input);
		$ekintzakAurretik    = EkintzakAurretik::find($id);
		$ekintzakAurretik->update($input);
		$tipo        = $ekintzakAurretik->tipo;
		return redirect()->route('ekintzakAurretik.index', compact( 'tipo'))
			->with('success', __('Zuzen aldatatu da'));
	}

	public function destroy($id, $tipo)
	{
		EkintzakAurretik::find($id)->delete();
		return redirect()->route('ekintzakAurretik.index', compact('tipo'))
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
		if(isset($request['titulo_eu'])) {
			if($request['titulo_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('titulo_es', 'like', "%".trim( $request['titulo_eu'] )."%");
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
		if(isset($request['desc_eu'])) {
			if($request['desc_eu'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('desc_es', 'like', "%".trim( $request['desc_eu'] )."%");
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
		$q    = EkintzakAurretik::query();
		$q    = $this->crearSql($q, $request);
		$data = $q->orderBy('id','DESC')
				->paginate(25);
		$sql  = Functions::getSql($q, $q->toSql());
		$tipo = $request['tipo'];
		\Session::put('search', '1');
		return view('ekintzakAurretik.index',compact('data', 'tipo')) ;
	}

}

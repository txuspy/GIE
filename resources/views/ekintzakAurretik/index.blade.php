@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('ekintzakAurretik', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'aurretik' )
								<h2>{{ __('Unibertsitate aurreko ikasleei bideratutako ekintzak') }}</h2>
    						@else
    							<h2>{{ __('Unibertsitate aurreko ikasleei bideratutako ekintzak') }}</h2>
							@endif
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('ekintzakAurretik.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('ekintzakAurretik.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> </a>
						</div>


					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif

				@include('ekintzakAurretik.search')

				<table class="table">
					<tr>
						<th colspan="2">{{ __('Izenburua') }}</th>
						<!---<th>{{ __('Deskripzioa') }}</th>-->
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $ekintza)
					<tr>
						<td colspan="2">
							<?php
							$titulo = "titulo_".\Session::get('locale') ;
							$desc = "desc_".\Session::get('locale') ;

							?>
							<a href="{{ route('ekintzakAurretik.edit',$ekintza->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>{{ $ekintza->$titulo }}</a>
							<br> ( {{ $ekintza->fecha }}  )
							<br> <i>{{ $ekintza->usuario?$ekintza->usuario->name:'' }} {{ $ekintza->usuario?$ekintza->usuario->lname:'' }}
							 {{ \App\Traits\Listados::fechasIndex($ekintza)}} </small></i>

						</td>
<!---
						<td>
							<a href="{{ route('ekintzakAurretik.edit',$ekintza->id) }}">{!! $ekintza->$desc !!}</a>

						</td>
-->
						<td>
							<a class="btn btn-primary" href="{{ route('ekintzakAurretik.edit',$ekintza->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>
								<i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $ekintza->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['ekintzakAurretik.destroy', $ekintza->id, $ekintza->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td  class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria::' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
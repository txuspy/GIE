@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('visitas') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Instalazio bisitak') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('visitas.indexAll' ) }}"><i class="fa fa-list" title="{{ __('Guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info  mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('visitas.create'  ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
						</div>



					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif
				@include('visitas.search')
				<table class="table">
					<tr>
						<th>{{ __('Aktibitatea') }}</th>
						<th>{{ __('Irakaslea(k)') }}</th>
						<th>{{ __('Data') }}</th>
						<th>{{ __('Akzioak') }}</th>

					</tr>
					@foreach ($data as $key => $visita)
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a  href="{{ route('visitas.edit',$visita->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>{{ $visita->$titulo }}</a>
							<br> <i><small>{{ $visita->usuario?$visita->usuario->name:'' }} {{ $visita->usuario?$visita->usuario->lname:'' }} {{ \App\Traits\Listados::fechasIndex($visita)}}
							</small></i>
						</td>
						<td>
							@foreach( $visita->autores as $autor)
			 					{{$autor->nombre}} {{$autor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>{{ $visita->fecha }}</td>
						<td>
							<a class="btn btn-primary" href="{{ route('visitas.edit',$visita->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $visita->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['visitas.destroy', $visita->id ],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan ='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('postgrados', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'master' )
								<h2>{{ __('Masterretan parte-hartzea') }}</h2>
    						@else
    							<h2>{{ __('Doktoretza-programetan parte-hartzea') }}</h2>
							@endif
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('postgrados.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('postgrados.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
						</div>

					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif

				@include('postgrados.search')

				<table class="table">
					<tr>
						<th>{{ __('Programa') }}</th>
						<th>{{ __('Kurtsoa') }}</th>
						<th>{{ __('Saila') }}</th>
						<th>{{ __('Data') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $postgrado)
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a  href="{{ route('postgrados.edit',$postgrado->id) }}">{{ $postgrado->$titulo }}</a>
							<br> <i>({{ $postgrado->usuario?$postgrado->usuario->name:'' }} {{ $postgrado->usuario?$postgrado->usuario->lname:'' }})</i>
						</td>
						<td>
							<?php $curso = "curso_".\Session::get('locale') ;?>
							<a  href="{{ route('postgrados.edit',$postgrado->id) }}">{{ $postgrado->$curso }}</a>
						</td>
						<td>
							{{ \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$postgrado->departamento]??'---' }}
						</td>
						<td>
							{{ $postgrado->fecha }}
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('postgrados.edit',$postgrado->id) }}"><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $postgrado->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['postgrados.destroy', $postgrado->id, $postgrado->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan ='3' class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
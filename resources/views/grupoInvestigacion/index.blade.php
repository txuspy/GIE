@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('grupoInvestigacion') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Ikerkuntza taldea') }}</h2>
						</div>
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="{{ route('grupoInvestigacion.indexAll') }}"><i class="fa fa-eye" title="{{ __('Ikerkuntza taldea guztiak ikusi') }}"></i></a>
						</div>

                    	<div class="pull-left margen-left">
							<a class="btn btn-info" href="{{ url(App\Lib\Functions::parseLang().'/grupoInvestigacion/word') }}" >
							<i class="fa fa-file-word-o" title="{{ __('Word sortu') }}"></i> </a>
						</div>
<!--
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="{{ url(App\Lib\Functions::parseLang().'/grupoInvestigacion/envioEmail') }}" >
							<i class="fa fa-envelope"></i> {{ __('Emaila bidali') }}</a>
						</div>
-->
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('grupoInvestigacion.create') }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> </a>
						</div>
					</div>
				</div>
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
				@endif
				<table class="table">
					<tr>
						<th>{{ __('Taldea')}}</th>
						<th>{{ __('Arduraduna(k)') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $grupoInv)
					<tr>
						<td>
							<?php $grupo = "grupo_".\Session::get('locale') ;?>
							<a class='' href="{{ route('grupoInvestigacion.edit',$grupoInv->id) }}">
								{{ $grupoInv->$grupo }}, ( {{ $grupoInv->desde }} - {{ $grupoInv->hasta }} )
							</a>
							<br> <i>({{ $grupoInv->usuario?$grupoInv->usuario->name:'' }} {{ $grupoInv->usuario?$grupoInv->usuario->lname:'' }})</i>
						</td>
						<td>
							@foreach( $grupoInv->responsables as $responsable)
			 					{{$responsable->nombre}} {{$responsable->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('grupoInvestigacion.edit',$grupoInv->id) }}"><i class="fa fa-pencil" title="{{ __('Aldatu') }}"></i></a>
							@if( $grupoInv->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['grupoInvestigacion.destroy', $grupoInv->id],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('congresos') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Kongresu Zientifikoetan parte-hartzea') }}</h2>
						</div>
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="{{ route('congresos.indexAll') }}"><i class="fa fa-eye" title="{{ __('Kongresu zientifiko guztiak ikusi') }}"></i></a>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('congresos.create') }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
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
						<th>{{ __('Kongresu') }}</th>
						<th>{{ __('Arduraduna(k)') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $congreso)
					<tr>
						<td>
							<?php $congre = "congreso_".\Session::get('locale') ;?>
								<a href="{{ route('congresos.edit',$congreso->id) }}">
									{{ $congreso->$congre }}, ( {{ $congreso->desde }} - {{ $congreso->hasta }} )
									</a>
							<br> <i>({{ $congreso->usuario?$congreso->usuario->name:'' }} {{ $congreso->usuario?$congreso->usuario->lname:'' }})</i>
						</td>
						<td>
								@foreach( $congreso->profesores as $profesor)
			 					{{$profesor->nombre}} {{$profesor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('congresos.edit',$congreso->id) }}"><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $congreso->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['congresos.destroy', $congreso->id],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td  class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

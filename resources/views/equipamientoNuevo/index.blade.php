@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('equipamientoNuevo') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Hornikuntza Zientifikoa eskuratzea') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('equipamientoNuevo.create') }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
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
						<th>{{ __('Hornikuntza') }}</th>
						<th>{{ __('Departamento') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@if($data)
						@foreach ($data as $key => $equipamientoNuevo)
						<tr>
							<td>
								<?php
								$equipo = "equipo_".\Session::get('locale') ;
								$departamento = "departamento_".\Session::get('locale') ;
								?>
								<a href="{{ route('equipamientoNuevo.edit',$equipamientoNuevo->id) }}">{{ $equipamientoNuevo->$equipo }}, ( {{ $equipamientoNuevo->data }} )</a>
								<br> <i>({{ $equipamientoNuevo->usuario?$equipamientoNuevo->usuario->name:'' }} {{ $equipamientoNuevo->usuario?$equipamientoNuevo->usuario->lname:'' }})</i>
							</td>
							<td>
								{{ \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$equipamientoNuevo->departamento]??'---' }}</td>
							<td>
								<a class="btn btn-primary" href="{{ route('equipamientoNuevo.edit',$equipamientoNuevo->id) }}"><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
								@if( $equipamientoNuevo->user_id == \Auth::user()->id )
									{!! Form::open(['method' => 'DELETE','route' => ['equipamientoNuevo.destroy', $equipamientoNuevo->id],'style'=>'display:inline']) !!}
									{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
									{!! Form::close() !!}
								@endif
							</td>
						</tr>
						@endforeach
						<tr>
							<td>{{ __('Guztira:' )}} {{ $data->total() }}</td>
							<td colspan='1' class='text-center'>{{ $data->links() }}</td>
							<td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td>
							</tr>
					@endif
				</table>
			</div>
@endsection

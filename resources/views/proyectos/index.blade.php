@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('proyectos', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'europa' )
								<h2>{{ __('Europar Batasuneko Programa Markoa') }}</h2>
    						@elseif ($tipo == 'erakundeak')
    							<h2>{{ __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
   							@else
    							<h2>{{ __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
							@endif
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('proyectos.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Proiektu guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('proyectos.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> </a>
						</div>


					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif

				@include('proyectos.search')

				<table class="table">
					<tr>
						<th>{{ __('Proiektua') }}</th>
						<th>{{ __('Finantziazioa') }}</th>
						<th>{{ __('Ikertzaile nagusia(k)') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $proyecto)
					<tr>
						<td>
							<?php $proiekto = "proyecto_".\Session::get('locale') ;?>
							<a href="{{ route('proyectos.edit',$proyecto->id) }}">{{ $proyecto->$proiekto }}</a>
							<br> ( {{ $proyecto->desde }} - {{ $proyecto->hasta }} )
							<br> <i>({{ $proyecto->usuario?$proyecto->usuario->name:'' }} {{ $proyecto->usuario?$proyecto->usuario->lname:'' }})</i>

						</td>
						<td>
							<a href="{{ route('proyectos.edit',$proyecto->id) }}">{{ $proyecto->financinacion }}</a>

						</td>
						<td>
							@foreach( $proyecto->directores as $director)
			 					{{$director->nombre}} {{$director->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('proyectos.edit',$proyecto->id) }}"><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $proyecto->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['proyectos.destroy', $proyecto->id, $proyecto->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td  class='text-center'>{{ $data->links() }}</td><td></td><td>{{ __('Oraingo orria::' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

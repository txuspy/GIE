@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('programasDeIntercambio', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'fuera' )
								<h2>{{ __('Egonaldi zientifikoak beste Unibertsitateetan') }}</h2>
							@elseif( $tipo == 'azp' )
								<h2>{{ __('IIP / AZPren mugikortasuna') }}</h2>
    						@else
    							<h2>{{ __('Etorritako ikerlariak') }}</h2>
							@endif
						</div>
							<div class="pull-left margen-left">
							<a class="btn btn-info" href="{{ route('programasDeIntercambio.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-eye" title="{{ __('Guztiak ikusi') }}"></i></a>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('programasDeIntercambio.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
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
						<th>{{ __('Aktibitea') }}</th>
						<th>
							@if( $tipo == 'azp' )
								{{ __('IIP / AZP') }}
							@else
								{{ __('Irakaslea(k)') }}
							@endif

						</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $programaDeIntercambio)
					<tr>
						<td>
							<?php $activ = "actividad_".\Session::get('locale') ;?>
								<a  href="{{ route('programasDeIntercambio.edit',$programaDeIntercambio->id) }}">
									{{ $programaDeIntercambio->$activ }}
									</a>
							<br> <i>({{ $programaDeIntercambio->usuario?$programaDeIntercambio->usuario->name:'' }} {{ $programaDeIntercambio->usuario?$programaDeIntercambio->usuario->lname:'' }})</i>
						</td>
						<td>
							@foreach( $programaDeIntercambio->profesores as $profesor)
			 					{{$profesor->nombre}} {{$profesor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('programasDeIntercambio.edit',$programaDeIntercambio->id) }}"><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $programaDeIntercambio->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['programasDeIntercambio.destroy', $programaDeIntercambio->id, $programaDeIntercambio->tipo],'style'=>'display:inline']) !!}
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

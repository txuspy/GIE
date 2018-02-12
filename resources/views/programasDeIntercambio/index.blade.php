@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('programasDeIntercambio', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'fuera' )
								<h2>{{ __('Egonaldi zientifikoak beste Unibertsitateetan') }}</h2>
    						@else
    							<h2>{{ __('Etorritako ikerlariak') }}</h2>
							@endif
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('programasDeIntercambio.create', [ 'tipo'=> $tipo ] ) }}"> {{ __('Berria sortu') }}</a>
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
						<th>Aktibitea</th>
						<th>Actividad</th>
						<th>{{ __('Irakaslea') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $programaDeIntercambio)
					<tr>
						<td>{{ $programaDeIntercambio->actividad_eu }}</td>
						<td>{{ $programaDeIntercambio->actividad_es }}</td>
						<td>
							@foreach( $programaDeIntercambio->profesores as $profesor)
			 					{{$profesor->nombre}} {{$profesor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('programasDeIntercambio.edit',$programaDeIntercambio->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['programasDeIntercambio.destroy', $programaDeIntercambio->id, $programaDeIntercambio->tipo],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

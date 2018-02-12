@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('proyectos', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
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
							<a class="btn btn-success" href="{{ route('proyectos.create', [ 'tipo'=> $tipo ] ) }}"> {{ __('Berria sortu') }}</a>
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
						<th>Proiektua</th>
						<th>Proyecto</th>
						<th>{{ __('Zuzendaria') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $proyecto)
					<tr>
						<td>{{ $proyecto->proyecto_eu }}</td>
						<td>{{ $proyecto->proyecto_es }}</td>
						<td>
							@foreach( $proyecto->directores as $director)
			 					{{$director->nombre}} {{$director->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('proyectos.edit',$proyecto->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['proyectos.destroy', $proyecto->id, $proyecto->tipo],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

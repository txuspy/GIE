@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('congresos') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Kongresu Zientifikoetan parte-hartzea') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('congresos.create') }}"> {{ __('Berria sortu') }}</a>
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
						<th>Kongresu</th>
						<th>Congreso</th>
						<th>{{ __('Arduraduna') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $congreso)
					<tr>
						<td>{{ $congreso->congreso_eu }}</td>
						<td>{{ $congreso->congreso_es }}</td>
						<td>
								@foreach( $congreso->profesores as $profesor)
			 					{{$profesor->nombre}} {{$profesor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('congresos.edit',$congreso->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['congresos.destroy', $congreso->id],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

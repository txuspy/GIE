@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('equipamientoNuevo') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Hornikuntza Zientifikoa eskuratzea') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('equipamientoNuevo.create') }}"> {{ __('Berria sortu') }}</a>
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

						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $equipamientoNuevo)
					<tr>
						<td>{{ $equipamientoNuevo->equipo_eu }}</td>
						<td>{{ $equipamientoNuevo->equipo_es }}</td>

						<td>
							<a class="btn btn-primary" href="{{ route('equipamientoNuevo.edit',$equipamientoNuevo->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['equipamientoNuevo.destroy', $equipamientoNuevo->id],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='1' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

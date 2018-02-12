@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('autores') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Partaideak') }}</h2>
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
						<th>{{ __('Nombre.') }}</th>
						<th>{{ __('Email') }}</th>
						<th>{{ __('Acciones') }}</th>
					</tr>
					@foreach ($data as $key => $autor)
					<tr>
						<td>{{ $autor->nombre }} </td>
						<td>{{ $autor->apellido }}</td>
						<td>
							<a class="btn btn-primary" href="{{ route('autor.edit',$autor->id) }}">Edit</a>
							{!! Form::open(['method' => 'DELETE','route' => ['autor.destroy', $autor->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Total:' )}} {{ $data->total() }}</td><td class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('grupoInvestigacion') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Ikerkuntza taldea') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('grupoInvestigacion.create') }}"> {{ __('Berria sortu') }}</a>
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
						<th>Taldea</th>
						<th>Grupo</th>
						<th>{{ __('Arduraduna') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $grupoInv)
					<tr>
						<td>{{ $grupoInv->grupo_eu }}</td>
						<td>{{ $grupoInv->grupo_es }}</td>
						<td></td>
						<td>
							<a class="btn btn-primary" href="{{ route('grupoInvestigacion.edit',$grupoInv->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['grupoInvestigacion.destroy', $grupoInv->id],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

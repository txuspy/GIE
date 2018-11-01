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

				</table>
			</div>
@endsection

@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('usuarios') !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2>{{ __('Erabiltzaileak') }}</h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('users.create') }}"> {{ __('Erabiltzaile berria sortu') }}</a>
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
						<th>{{ __('N.') }}</th>
						<th>{{ __('Nombre.') }}</th>
						<th>{{ __('Email') }}</th>
						<th>{{ __('Roles') }}</th>
						<th>{{ __('Acciones') }}</th>
					</tr>
					@foreach ($data as $key => $user)
					<tr>
						<td>{{ ++$i }}.) [ {!!  \App\Lib\FunctionsVistas::publicar($user->estado)!!} ]</td>
						<td>{{ $user->name }} {{ $user->lname }}</td>
						<td>{{ $user->email }}</td>

						<td>
							@if(!empty($user->roles))
							@foreach($user->roles as $v)
							<label class="label label-success">{{ $v->display_name }}</label>
							@endforeach
							@endif
						</td>
						<td>

							<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
							{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Total:' )}} {{ $data->total() }}</td><td colspan='3' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>

				</table>


			</div>

@endsection

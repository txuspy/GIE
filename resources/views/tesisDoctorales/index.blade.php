@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('tesisDoctorales', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							@if($tipo == 'proximaLectura')
								<h2>{{ __('Uneko Tesiak') }}</h2>
							@else
								<h2>{{ __('Burutu diren Tesiak') }}</h2>
							@endif
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('tesisDoctorales.create', [ 'tipo'=> $tipo ] ) }}"> {{ __('Berria sortu') }}</a>
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
						<th>Izenburua</th>
						<th>Titulo</th>
						<th>{{ __('Doctorando') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $tesis)
					<tr>
						<td>{{ $tesis->titulo_eu }}</td>
						<td>{{ $tesis->titulo_es }}</td>
						<td></td>
						<td>
							<a class="btn btn-primary" href="{{ route('tesisDoctorales.edit',$tesis->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['tesisDoctorales.destroy', $tesis->id, $tesis->tipo],'style'=>'display:inline']) !!}

							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

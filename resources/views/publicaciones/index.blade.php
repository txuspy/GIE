@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('publicaciones', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'libros' )
								<h2>{{ __('Liburuak eta Monografiak') }}</h2>
    						@else
    							<h2>{{ __('Artikuloak') }}</h2>
							@endif
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="{{ route('publicaciones.create', [ 'tipo'=> $tipo ] ) }}"> {{ __('Berria sortu') }}</a>
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
						<th>{{ __('Egileak') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $publicacion)
					<tr>
						<td>{{ $publicacion->titulo_eu }}</td>
						<td>{{ $publicacion->titulo_es }}</td>
						<td>
							@foreach( $publicacion->autores as $autor)
			 					{{$autor->nombre}} {{$autor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('publicaciones.edit',$publicacion->id) }}">{{ __('Aldatu')}}</a>
							{!! Form::open(['method' => 'DELETE','route' => ['publicaciones.destroy', $publicacion->id, $publicacion->tipo],'style'=>'display:inline']) !!}
							{!! Form::submit(__('Ezabatu'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan='2' class='text-center'>{{ $data->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection

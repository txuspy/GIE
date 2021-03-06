@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('publicaciones', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'libros' )
								<h2>{{ __('Liburuak eta monografiak') }}</h2>
    						@else
    							<h2>{{ __('Artikuloak') }}</h2>
							@endif
						</div>
						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('publicaciones.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Proiektu guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('publicaciones.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> </a>
						</div>


					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif
				@include('publicaciones.search')

				<table class="table">
					<tr>
						<th>{{ __('Izenburua') }}</th>
						<th>{{ __('Egilea(k)') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $publicacion)
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a  href="{{ route('publicaciones.edit',$publicacion->id) }}"
							@if(Session::get('search')=='1')
									target="_blank"
								@endif
							>{{ $publicacion->$titulo }}</a>
							<br> <i><small>{{ $publicacion->usuario?$publicacion->usuario->name:'' }} {{ $publicacion->usuario?$publicacion->usuario->lname:'' }}
							{{ \App\Traits\Listados::fechasIndex($publicacion)}} </small></i>
						</td>
						<td>
							@foreach( $publicacion->autores as $autor)
			 					{{$autor->nombre}} {{$autor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>
							<a class="btn btn-primary" href="{{ route('publicaciones.edit',$publicacion->id) }}"
							@if(Session::get('search')=='1')
									target="_blank"
								@endif
							><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $publicacion->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['publicaciones.destroy', $publicacion->id, $publicacion->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
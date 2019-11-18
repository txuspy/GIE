@extends('layouts.app')

@section('content')
	{!! Breadcrumbs::render('divulgacion', $tipo) !!}
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							@if( $tipo == 'prensa' )
								<h2>{{ __('Prentsa') }}</h2>
    						@else
    							<h2>{{ __('Hedakuntza') }}</h2>
							@endif
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('divulgacion.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Hedakuntza guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('divulgacion.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> </a>
						</div>


					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif

				@include('divulgacion.search')

				<table class="table">
					@if( $tipo == 'prensa' )
						<tr>
							<th>{{ __('Izenburua') }}</th>
							<th> </th>
							<th>{{ __('Akzioak') }}</th>
						</tr>
					@else
						<tr>
							<th colspan="2">{{ __('Izenburua') }}</th>
							<!--<th>{{ __('Deskripzioa') }}</th>-->
							<th>{{ __('Akzioak') }}</th>
						</tr>
					@endif
					@foreach ($data as $key => $divulgacion)
					<tr>
						@if( $tipo == 'prensa' )
							<td>
						@else
							<td colspan="2">
						@endif
							<?php 
							$titulo = "titulo_".\Session::get('locale') ;
							$desc = "desc_".\Session::get('locale') ;

							?>
							<a href="{{ route('divulgacion.edit',$divulgacion->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>{{ $divulgacion->$titulo }}</a>
							<br> ( {{ $divulgacion->fecha }}  )
							<br> <i>{{ $divulgacion->usuario?$divulgacion->usuario->name:'' }} {{ $divulgacion->usuario?$divulgacion->usuario->lname:'' }}
							 {{ \App\Traits\Listados::fechasIndex($divulgacion)}} </small></i>

						</td>
						@if( $tipo == 'prensa' )
							<td>
								<!--<a href="{{ route('divulgacion.edit',$divulgacion->id) }}">{{ $divulgacion->$desc }}</a>-->
								{{ $divulgacion->web }} 
							</td>
						@endif
						<td>
							<a class="btn btn-primary" href="{{ route('divulgacion.edit',$divulgacion->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>
								<i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $divulgacion->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['divulgacion.destroy', $divulgacion->id, $divulgacion->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td  class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria::' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
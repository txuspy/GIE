@extends('layouts.app')
@section('content')

	{!! Breadcrumbs::render('formaciones', $tipo, $modo) !!}
			<div class="panel panel-default">
				<div class="panel-body">

					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2>
								@if( $tipo == 'PDI' )
									{{  __('IIPko formazioa') }}
								@else
									{{  __('AZKko formazioa') }}
								@endif
								@if( $modo == 'recibir' )
									- {{  __('Jasotakoa') }}
								@else
									- {{  __('Emandakoa') }}
								@endif
							</h2>
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="{{ route('formaciones.indexAll', [ 'tipo'=> $tipo ,  'modo'=> $modo ]) }}"><i class="fa fa-list" title="{{ __('Guztiak ikusi') }}"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('formaciones.create', [ 'tipo'=> $tipo, 'modo'=> $modo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
						</div>


					</div>
				</div>



				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
				@endif

				@include('formaciones.search')
				<table class="table">
					<tr>
						<th>{{ __('Ikastaro') }}</th>
						<th>{{ __('Tokia') }}</th>
						<th>

							@if( $modo == 'recibir' )
								{{ __('Parte-hartzailea(k)') }}
							@else
								{{ __('Hizlaria(k)') }}
							@endif


						</th>
						<th>{{ __('Data') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $formacion)
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a  href="{{ route('formaciones.edit',$formacion->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>{{ $formacion->$titulo }}</a>
							<br> <i>({{ $formacion->usuario?$formacion->usuario->name:'' }} {{ $formacion->usuario?$formacion->usuario->lname:'' }})</i>
						</td>
						<td>
							{{ $formacion->lugar }}
						</td>
						<td>

							@foreach( $formacion->autores as $autor)
			 					{{$autor->nombre}} {{$autor->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach

						</td>
						<td>{{ $formacion->fecha }}</td>
						<td>
							<a class="btn btn-primary" href="{{ route('formaciones.edit', $formacion->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $formacion->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['formaciones.destroy', $formacion->id , $formacion->tipo , $formacion->modo ],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td class='text-center' colspan ='3'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
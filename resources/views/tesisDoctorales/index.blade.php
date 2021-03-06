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
								<h2>{{ __('Tesiak') }}</h2>
							@endif
						</div>
						<div class="pull-right">
								<a class="btn btn-info" href="{{ route('tesisDoctorales.indexAll', [ 'tipo'=> $tipo ]) }}"><i class="fa fa-list" title="{{ __('Guztiak ikusi') }}"></i></a>

								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="{{ __('Bilatu') }}" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="{{ route('tesisDoctorales.create', [ 'tipo'=> $tipo ] ) }}"><i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i></a>
						</div>



					</div>
				</div>

				@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
				@endif
					@include('tesisDoctorales.search')
				<table class="table table-striped">
					<tr>
						<th>{{ __('Izenburua') }}</th>
						<th>{{ __('Saila') }}</th>
						<th>{{ __('Ikerlaria(k)')}}</th>
						<th>{{ __('Data') }}</th>
						<th>{{ __('Akzioak') }}</th>
					</tr>
					@foreach ($data as $key => $tesis)
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a href="{{ route('tesisDoctorales.edit',$tesis->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							>{{ $tesis->$titulo }}</a>
							<br> <i><small>{{ $tesis->usuario?$tesis->usuario->name:'' }} {{ $tesis->usuario?$tesis->usuario->lname:'' }} {{ \App\Traits\Listados::fechasIndex($tesis)}} </small></i>
						</td>
						<td>
							{{ \App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$tesis->departamento]??'---' }}
						</td>
						<td>
							@foreach( $tesis->doctorandos as $doctorando)
			 					{{$doctorando->nombre}} {{$doctorando->apellido}}
			 					@if(!$loop->last)
			 						,
			 					@endif
			 				@endforeach
						</td>
						<td>{{ $tesis->fechaLectura }}</td>
						<td>
							<a class="btn btn-primary" href="{{ route('tesisDoctorales.edit',$tesis->id) }}"
							@if(Session::get('search')=='1')
								target="_blank"
							@endif
							><i class="fa fa-pencil" title="{{ __('Aldadtu') }}"></i></a>
							@if( $tesis->user_id == \Auth::user()->id )
								{!! Form::open(['method' => 'DELETE','route' => ['tesisDoctorales.destroy', $tesis->id, $tesis->tipo],'style'=>'display:inline']) !!}
								{{ Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
								{!! Form::close() !!}
							@endif
						</td>
					</tr>
					@endforeach
					<tr><td>{{ __('Guztira:' )}} {{ $data->total() }}</td><td colspan ='3' class='text-center'>{{ $data->links() }}</td><td>{{ __('Oraingo orria:' )}} {{ $data->currentPage() }}</td></tr>
				</table>
			</div>
@endsection
{{ \Session::put('search', '0') }}
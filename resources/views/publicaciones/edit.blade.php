@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('publicacionesEdit', $publicacion) !!}
   <div class="panel panel-default">
       @if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
    	@endif
    	@if (count($errors) > 0)
    		<div class="alert alert-danger">
    			<strong>{{ __('Whoops!') }}</strong> {{ __('There were some problems with your input.') }}<br><br>
    			<ul>
    				@foreach ($errors->all() as $error)
    					<li>{{ $error }}</li>
    				@endforeach
    			</ul>
    		</div>
    	@endif
		<div class="panel-body">
			<div class="col-sm-12 margin-tb">
		        <div class="pull-left">
		           	@if( $publicacion->tipo == 'libros' )
						<h2>{{ __('Liburuak eta Monografiak') }}</h2>
					@else
						<h2>{{ __('Artikuloak') }}</h2>
					@endif
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('publicaciones.index', ['tipo'  => $publicacion->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogPublicacionesAutores",
				'idForm'=>'formdialogPublicacionesAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			])

			{!! Form::model($publicacion, ['method' => 'PUT','route' => ['publicaciones.update', $publicacion->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Izenburua:</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">

		           @if( $publicacion->tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('Argitaletxea') }} :</strong></label>
			                {!! Form::text('editorialRevisa',  null , array('placeholder' => __('Argitaletxea') ,'class' => 'buscadorAldikariak form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('Aldizkaria') }} :</strong></label>
		                	{!! Form::text('editorialRevisa',  null , array('placeholder' => __('Aldizkaria') ,'class' => 'form-control buscadorAldikariak')) !!}
		            	</div>
		            @endif


		        </div>
		        {{--
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo:</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')) !!}
		            </div>
		        </div>
		        --}}
		    </div>

		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		        	@if( $publicacion->tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('Kapitulo') }} :</strong></label>
			                {!! Form::text('capitulo',  null , array('placeholder' => __('Kapitulo') ,'class' => ' form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('Bolumena') }} :</strong></label>
		                	{!! Form::text('volumen',  null , array('placeholder' => __('Bolumena') ,'class' => ' form-control')) !!}
		            	</div>
		            @endif
		        </div>
		         <div class="col-sm-6 ">
		        	@if( $publicacion->tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('ISBN') }} :</strong></label>
			                {!! Form::text('ISBN',  null , array('placeholder' => __('ISBN') ,'class' => ' form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('ISSN') }} :</strong></label>
		                	{!! Form::text('ISBN',  null , array('placeholder' => __('ISSN') ,'class' => ' form-control')) !!}
		            	</div>
		            @endif
		        </div>


		    </div>
		    <div>
		    	<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Data') }} :</strong></label>
		                {!! Form::text('year', null , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')) !!}
		            </div>
		        </div>
		    	<div class="col-sm-6">
		    		<label><strong>{{ __('Egilea(k)')}}:</strong></label>
		    	 	{{Form::text('publicacionesAutores', '', [
				        'id'           =>'publicacionesAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogPublicacionesAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'publicaciones',
				        'data-idUl'    =>'ulPublicacionesAutores',
				        'data-id'      => $publicacion->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulPublicacionesAutores" class="list-group">
			 			@foreach( $publicacion->autores as $autor)
			 				<li class="list-group-item" id="detachAutores{{ $autor->id }}">
				 				<a data-id='{{$publicacion->id}}' data-idAutor='{{ $autor->id }}' data-carpeta ='autores' data-tipo='publicaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$autor->nombre}} {{$autor->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	{{ Form::hidden('tipo', $publicacion->tipo) }}
					<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
		        </div>
			{!! Form::close() !!}
		</div>
	</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
@endsection

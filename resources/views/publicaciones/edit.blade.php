@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('publicacionesEdit', $publicacion) !!}
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
	@include('layouts.dialog', [
		'idDialog' => "dialogPublicacionesAutores",
		'idForm'=>'formdialogPublicacionesAutores',
		'tituloContenido' => __('Egile berria sortu') ,
	])

	{!! Form::model($publicacion, ['method' => 'PUT','route' => ['publicaciones.update', $publicacion->id]]) !!}
	<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Izenburua:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                {!! Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Editorial / revista') }} :</strong></label>
                {!! Form::text('editorialRevisa', null, array('placeholder' => __('Editorial / revista') ,'class' => 'form-control')) !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xs-6 ">
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
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Urtea') }} :</strong></label>
                {!! Form::text('year', null , array('placeholder' => __('Urtea') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-xs-6">
    		<label><strong>{{ __('Egilea')}}:</strong></label>
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
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
        	{{ Form::hidden('tipo', $publicacion->tipo) }}
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

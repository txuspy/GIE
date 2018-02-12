@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('programasDeIntercambioEdit', $programaDeIntercambio) !!}
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
		'idDialog' => "dialogProgramaDeIntercambioProfesores",
		'idForm'=>'formdialogProgramaDeIntercambioProfesores',
		'tituloContenido' => __('Irakaslea berria sortu') ,
	])

	{!! Form::model($programaDeIntercambio, ['method' => 'PUT','route' => ['programasDeIntercambio.update', $programaDeIntercambio->id]]) !!}
	<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Aktibitea:</strong></label>
                {!! Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Actividad:</strong></label>
                {!! Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Tokia') }} :</strong></label>
                {!! Form::text('lugar', null, array('placeholder' => __('Tokia') ,'class' => 'form-control')) !!}
            </div>
        </div>

    </div>
     <div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Noiztik') }} :</strong></label>
                {!! Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Arte') }} :</strong></label>
                {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-xs-6">
    		<label><strong>{{ __('Irakaslea')}}:</strong></label>
    	 	{{Form::text('programaDeIntercambioProfesores', '', [
		        'id'           =>'programaDeIntercambioProfesores',
		        'placeholder'  =>__('Egilea bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogProgramaDeIntercambioProfesores',
		        'data-carpeta' =>'profesor',
		        'data-tipo'    =>'programasDeIntercambio',
		        'data-idUl'    =>'ulProgramaDeIntercambioProfesores',
		        'data-id'      => $programaDeIntercambio->id
    	 	]
    	 	)}}
	 		<br><ul id="ulProgramaDeIntercambioProfesores" class="list-group">
	 			@foreach( $programaDeIntercambio->profesores as $profesor)
	 				<li class="list-group-item" id="detachProfesores{{ $profesor->id }}">
		 				<a data-id='{{$programaDeIntercambio->id}}' data-idAutor='{{ $profesor->id }}' data-carpeta ='profesor' data-tipo='programasDeIntercambio'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$profesor->nombre}} {{$profesor->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>

	</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
        	{{ Form::hidden('tipo', $programaDeIntercambio->tipo) }}
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

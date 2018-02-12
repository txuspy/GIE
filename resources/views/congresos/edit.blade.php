@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('congresosEdit', $congreso) !!}
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
		'idDialog' => "dialogCongresoProfesor",
		'idForm'=>'formdialogCongresoProfesor',
		'tituloContenido' => __('Irakasle berria sortu') ,
	])

	{!! Form::model($congreso, ['method' => 'PATCH','route' => ['congresos.update', $congreso->id]]) !!}
<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Kongresu:</strong></label>
                {!! Form::text('congreso_eu', null, array('placeholder' => 'Grupo','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Congreso:</strong></label>
                {!! Form::text('congreso_es', null, array('placeholder' => 'Taldea','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Konferentzi/Posterra') }} :</strong></label>
                {!! Form::text('conferenciaPoster', null, array('placeholder' => __('Konferentzi/Posterra') ,'class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Tokia') }} :</strong></label>
                {!! Form::text('lugar', null, array('placeholder' => __('Tokia'),'class' => 'form-control')) !!}
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
    	<div class="col-md-6 ">
    		<label><strong>{{ __('Irakasle')}}:</strong></label>
    	 	{{Form::text('CongresoProfesor', '', [
		        'id'           =>'CongresoProfesor',
		        'placeholder'  =>__('Irakaslea bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogCongresoProfesor',
		        'data-carpeta' =>'profesor',
		        'data-tipo'    =>'congresos',
		        'data-idUl'    =>'ulCongresoProfesor',
		        'data-id'      => $congreso->id
    	 	]
    	 	)}}
	 		<br><ul id="ulCongresoProfesor" class="list-group">
	 			@foreach( $congreso->profesores as $profesor)
	 				<li class="list-group-item" id="detachProfesor{{ $profesor->id }}">
		 				<a data-id='{{$congreso->id}}' data-idAutor='{{ $profesor->id }}' data-carpeta ='profesor' data-tipo='congresos'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$profesor->nombre}} {{$profesor->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>

	</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 ">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

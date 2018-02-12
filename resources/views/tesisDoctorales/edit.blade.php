@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('tesisDoctoralesEdit', $tesisDoctoral) !!}
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
		'idDialog' => "dialogTesisDoctoralesDirector",
		'idForm'=>'formdialogTesisDoctoralesDirector',
		'tituloContenido' => __('Zuzendari berria sortu') ,
	])
	@include('layouts.dialog', [
		'idDialog' => "dialogTesisDoctoralesDoctorando",
		'idForm'=>'formdialogTesisDoctoralesDoctorando',
		'tituloContenido' => __('Doctorando berria sortu') ,
	])
	{!! Form::model($tesisDoctoral, ['method' => 'PUT','route' => ['tesisDoctorales.update', $tesisDoctoral->id]]) !!}
		<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Izenburua:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Saila :</strong></label>
                {!! Form::text('departamento_eu', null, array('placeholder' => 'Saila','class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Departamento :</strong></label>
                {!! Form::text('departamento_es', null, array('placeholder' => 'Departamento','class' => 'form-control')) !!}
            </div>
        </div>
    </div><div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Data') }} :</strong></label>
                {!! Form::text('fechaLectura', $tesisDoctoral->fechaLectura , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>

    </div>
    <div class="row">
    	<div class="col-xs-6">
    		<label><strong>{{ __('Zuzendaria')}}:</strong></label>
    	 	{{Form::text('tesisDoctoralesDirector', '', [
		        'id'           =>'tesisDoctoralesDirector',
		        'placeholder'  =>__('Zuzendaria bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogTesisDoctoralesDirector',
		        'data-carpeta' =>'director',
		        'data-tipo'    =>'tesisDoctorales',
		        'data-idUl'    =>'ulTesisDoctoralesDirector',
		        'data-id'      => $tesisDoctoral->id
    	 	]
    	 	)}}
	 		<br><ul id="ulTesisDoctoralesDirector" class="list-group">
	 			@foreach( $tesisDoctoral->directores as $director)
	 				<li class="list-group-item" id="detachDirector{{ $director->id }}">
		 				<a data-id='{{$tesisDoctoral->id}}' data-idAutor='{{ $director->id }}' data-carpeta ='director' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$director->nombre}} {{$director->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	 	<div class="col-xs-6 ">
    		<label><strong>{{ __('Doktorando')}}:</strong></label>
    	 	{{Form::text('tesisDoctoralesDoctorando', '', [
	         'id'           =>'tesisDoctoralesDoctorando ',
	         'placeholder'  =>__('Doktorandoa bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogTesisDoctoralesDoctorando',
	         'data-carpeta' =>'doctorando',
	         'data-tipo'    =>'tesisDoctorales',
	         'data-idUl'    =>'ulTesisDoctoralesDoctorando',
	         'data-id'      => $tesisDoctoral->id
	        ])}}
	 		<br><ul id="ulTesisDoctoralesDoctorando" class="list-group">
	 			@foreach( $tesisDoctoral->doctorandos as $doctorando)
	 				<li class="list-group-item"  id="detachDoctorando{{ $director->id }}">
	 					<a data-id='{{$tesisDoctoral->id}}' data-idAutor='{{ $doctorando->id }}' data-carpeta ='doctorando' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					{{$doctorando->nombre}} {{$doctorando->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
        	{{ Form::hidden('tipo', $tesisDoctoral->tipo) }}
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

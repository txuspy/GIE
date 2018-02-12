@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('proyectosEdit', $proyecto) !!}
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
		'idDialog' => "dialogProyectosDirector",
		'idForm'=>'formdialogProyectosDirector',
		'tituloContenido' => __('Zuzendari berria sortu') ,
	])
	@include('layouts.dialog', [
		'idDialog' => "dialogProyectosInvestigador",
		'idForm'=>'formdialogProyectosInvestigador',
		'tituloContenido' => __('Doctorando berria sortu') ,
	])
	{!! Form::model($proyecto, ['method' => 'PUT','route' => ['proyectos.update', $proyecto->id]]) !!}
		<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Proiektua:</strong></label>
                {!! Form::text('proyecto_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Proyecto:</strong></label>
                {!! Form::text('proyecto_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Finantziazioa') }} :</strong></label>
                {!! Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')) !!}
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
    		<label><strong>{{ __('Zuzendaria')}}:</strong></label>
    	 	{{Form::text('proyectosDirector', '', [
		        'id'           =>'proyectosDirector',
		        'placeholder'  =>__('Arduraduna bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogProyectosDirector',
		        'data-carpeta' =>'director',
		        'data-tipo'    =>'proyectos',
		        'data-idUl'    =>'ulProyectosDirector',
		        'data-id'      => $proyecto->id
    	 	]
    	 	)}}
	 		<br><ul id="ulProyectosDirector" class="list-group">
	 			@foreach( $proyecto->directores as $director)
	 				<li class="list-group-item" id="detachDirector{{ $director->id }}">
		 				<a data-id='{{$proyecto->id}}' data-idAutor='{{ $director->id }}' data-carpeta ='director' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$director->nombre}} {{$director->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	 	<div class="col-xs-6 ">
    		<label><strong>{{ __('Ikertzailea')}}:</strong></label>
    	 	{{Form::text('proyectosInvestigador', '', [
	         'id'           =>'tesisproyectosInvestigador',
	         'placeholder'  =>__('Ikertzailea bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogProyectosInvestigador',
	         'data-carpeta' =>'doctorando',
	         'data-tipo'    =>'proyectos',
	         'data-idUl'    =>'ulProyectosInvestigador',
	         'data-id'      => $proyecto->id
	        ])}}
	 		<br><ul id="ulProyectosInvestigador" class="list-group">
	 			@foreach( $proyecto->investigadores as $investigador)
	 				<li class="list-group-item"  id="detachDoctorando{{ $director->id }}">
	 					<a data-id='{{$proyecto->id}}' data-idAutor='{{ $investigador->id }}' data-carpeta ='doctorando' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					{{$investigador->nombre}} {{$investigador->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
        	{{ Form::hidden('tipo', $proyecto->tipo) }}
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

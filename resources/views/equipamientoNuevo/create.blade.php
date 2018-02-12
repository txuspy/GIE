@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('equipamientoNuevo') !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>{{ __('Hornikuntza Zientifikoa eskuratzea')}}</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('equipamientoNuevo.index') }}"> {{ __('Atzera') }}</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> {{ __('Akats batzuk daude ')}}<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(array('route' => 'equipamientoNuevo.store','method'=>'POST', 'class'=>'form' )) !!}
	<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Departamentua:</strong></label>
                {!! Form::text('departamento_eu', null, array('placeholder' => 'Departamentua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Departamento:</strong></label>
                {!! Form::text('departamento_es', null, array('placeholder' => 'Departamento','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Taldea:</strong></label>
                {!! Form::text('equipo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Equipo:</strong></label>
                {!! Form::text('equipo_es', null, array('placeholder' => 'Equipo','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Instituzioa') }} :</strong></label>
                {!! Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>{{ __('Zenbateko') }} :</strong></label>
                {!! Form::text('importe', null, array('placeholder' => __('Zenbateko'),'class' => 'form-control')) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{{ Form::hidden('user_id', \Auth::user()->id) }}
	{!! Form::close() !!}
    </div>
@endsection
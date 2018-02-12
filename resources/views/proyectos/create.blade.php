@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('proyectos', $tipo) !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            @if( $tipo == 'europa' )
					<h2>{{ __('Europar Batasuneko Programa Markoa') }}</h2>
				@elseif ($tipo == 'erakundeak')
					<h2>{{ __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
   				@else
					<h2>{{ __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
				@endif
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('proyectos.index', ['tipo'  => $tipo ]) }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'proyectos.store','method'=>'POST', 'class'=>'form' )) !!}
	<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Proiektua:</strong></label>
                {!! Form::text('proyecto_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Proyecto:</strong></label>
                {!! Form::text('proyecto_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')) !!}
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
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::hidden('tipo', $tipo) }}
            {{ Form::hidden('user_id', \Auth::user()->id) }}
			<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{!! Form::close() !!}
    </div>
@endsection
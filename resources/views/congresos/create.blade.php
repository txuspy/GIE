@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('congresos') !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>{{ __('Kongresu Zientifikoetan parte-hartzea')}}</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('congresos.index') }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'congresos.store','method'=>'POST', 'class'=>'form' )) !!}
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
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{{ Form::hidden('user_id', \Auth::user()->id) }}
	{!! Form::close() !!}
    </div>
@endsection
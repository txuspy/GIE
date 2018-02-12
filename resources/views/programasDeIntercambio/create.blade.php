@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('programasDeIntercambio', $tipo) !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	           	@if( $tipo == 'fuera' )
					<h2>{{ __('Egonaldi zientifikoak beste Unibertsitateetan') }}</h2>
				@else
					<h2>{{ __('Etorritako ikerlariak') }}</h2>
				@endif
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('programasDeIntercambio.index', ['tipo'  => $tipo ]) }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'programasDeIntercambio.store','method'=>'POST', 'class'=>'form' )) !!}
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
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            {{ Form::hidden('tipo', $tipo) }}
            {{ Form::hidden('user_id', \Auth::user()->id) }}
			<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{!! Form::close() !!}
    </div>
@endsection
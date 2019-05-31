@extends('layouts.app')

@section('content')
    <div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>{{ __('Erabiltzaile berria')}}</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'users.store','method'=>'POST', 'class'=>'form' )) !!}
	<div class="row">
		<div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Izena') }}:</strong></label>
                {!! Form::text('name', null, array('placeholder' => __('Izena'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Abizenak') }} :</strong></label>
                {!! Form::text('lname', null, array('placeholder' => __('Abizenak'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Estado') }} :</strong></label>
                {!! Form::select('estado', ['1' => __('Activo'), '0' => __('Baja') ],1 , ['class' => 'form-control chosen-type'])  !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{--
        <div class="col-xs-4 ">

            <div class="form-group">
                <label><strong>{{ __('WebUntis') }}:</strong></label>
                {!! Form::text('WebUntis', null, array('placeholder' => __('WebUntis') ,'class' => 'form-control')) !!}
            </div>
        </div>
        --}}
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Posta elektronikoa') }}:</strong></label>
                {!! Form::text('email', null, array('placeholder' => __('Posta elektronikoa'),'class' => 'form-control')) !!}
            </div>
        </div>
       <div class="col-xs-4">
            <div class="form-group">
                <label><strong>{{ __('Hizkuntza') }} :</strong></label>
                {!! Form::select('lng', ['eu' => 'Euskara', 'es' => 'Castellano' ],1 , ['class' => 'form-control chosen-type'])  !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Pasahitza') }} :</strong></label>
                {!! Form::password('password', array('placeholder' => __('Pasahitza'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Pasahitza Konfirmatu') }}:</strong></label>
                {!! Form::password('confirm-password', array('placeholder' => __('Pasahitza Konfirmatu'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group  input-text-wrapper">
                <label><strong>{{ __('Errola') }}:</strong></label>
                {!! Form::select('roles[]', $roles, 4, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{!! Form::close() !!}
    </div>
@endsection
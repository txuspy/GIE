@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('grupoInvestigacion') !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>{{ __('Ikerkuntza taldea')}}</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('grupoInvestigacion.index') }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'grupoInvestigacion.store','method'=>'POST', 'class'=>'form' )) !!}
	<div class="row">
	     <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Taldea:</strong></label>
                {!! Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Grupo:</strong></label>
                {!! Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control')) !!}
            </div>
        </div>

    </div>
	<div class="row">
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Líneas de investigación :</strong></label>
                {!! Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control')) !!}
            </div>
        </div>
         <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Ikerkuntza lerroak :</strong></label>
                {!! Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control')) !!}
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
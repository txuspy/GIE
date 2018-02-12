@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('equipamientoNuevoEdit', $equipamientoNuevo) !!}
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

	{!! Form::model($equipamientoNuevo, ['method' => 'PATCH','route' => ['equipamientoNuevo.update', $equipamientoNuevo->id]]) !!}
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
                {!! Form::text('departamento_eu', null, array('placeholder' => 'Departamento','class' => 'form-control')) !!}
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
                {!! Form::text('equipo_eu', null, array('placeholder' => 'Equipo','class' => 'form-control')) !!}
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
        <div class="col-xs-10 col-sm-10 col-md-10 ">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

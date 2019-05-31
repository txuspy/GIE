@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('autoresEdit', $autor) !!}
    <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
		<strong> {{ __('Upload OK.') }}</strong>
	</div>
	<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
		<strong> {{ __('Upload ERROR.') }}</strong>
	</div>
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
	{!! Form::model($autor, ['method' => 'PATCH','route' => ['autor.update', $autor->id]]) !!}
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Izena') }}:</strong>
                {!! Form::text('nombre', null, array('placeholder' => __('Izena'),'class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Abizenak') }}:</strong>
                {!! Form::text('apellido', null, array('placeholder' => __('Abizenak') ,'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{!! Form::close() !!}
	</div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        	{!! Breadcrumbs::render('publicaciones', $tipo) !!}
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	           	@if( $tipo == 'libros' )
					<h2>{{ __('Liburuak eta Monografiak') }}</h2>
				@else
					<h2>{{ __('Artikuloak') }}</h2>
				@endif
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('publicaciones.index', ['tipo'  => $tipo ]) }}"> {{ __('Atzera') }}</a>
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
	{!! Form::open(array('route' => 'publicaciones.store','method'=>'POST', 'class'=>'form' )) !!}
	<div class="row">
		<div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Izenburua:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                {!! Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')) !!}
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
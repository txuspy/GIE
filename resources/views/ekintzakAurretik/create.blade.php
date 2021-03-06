@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('ekintzakAurretik', $tipo) !!}
	<div class="panel panel-default">
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
		<div class="panel-body">
			<div class="col-sm-12 margin-tb">
				<div class="pull-left">
					@if( $tipo == 'aurretik' )
						<h2>{{ __('Unibertsitate aurreko ikasleei bideratutako ekintzak') }}</h2>
					@else
						<h2>{{ __('Unibertsitate aurreko ikasleei bideratutako ekintzak') }}</h2>
					@endif
				</div>
				<div class="pull-right">
					<a class="btn btn-primary" href="{{ route('ekintzakAurretik.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
				</div>
			</div>

	{!! Form::open(array('route' => 'ekintzakAurretik.store','method'=>'POST', 'class'=>'form' )) !!}
	<div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Izenburua (*):</strong></label>
				@if ($errors->has('titulo_eu'))
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				@endif
				{!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Titulo (*):</strong></label>
				@if ($errors->has('titulo_es'))
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				@endif
				{!! Form::text('titulo_es', null, array('placeholder' => 'Izenburua','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
			</div>
		</div>
	   <div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Deskripzioa (*):</strong></label>
				@if ($errors->has('desc_eu'))
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				@endif
				{!! Form::textarea('desc_eu', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote', 'data-tipo'  => $tipo)) !!}

			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Descripción (*):</strong></label>
				@if ($errors->has('desc_es'))
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				@endif
				{!! Form::textarea('desc_es', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote', 'data-tipo'  => $tipo)) !!}
			</div>
		</div>
	</div>

	<div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>{{ __('Data') }} (*):</strong></label>
				@if ($errors->has('fecha'))
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				@endif
				{!! Form::text('fecha',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
			</div>
		</div>
	</div>

	<div>
		<div class="col-sm-12 ">
			<p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
		</div>
	</div>
	<div>
		<div class="col-md-12 col-sm-12 col-md-12 text-center">
			{{ Form::hidden('tipo', $tipo) }}
			{{ Form::hidden('user_id', \Auth::user()->id) }}
			<button type="submit" class="btn btn-success">
			   <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
			</button>
		</div>
	</div>
	{!! Form::close() !!}
	</div>
	</div>
@endsection
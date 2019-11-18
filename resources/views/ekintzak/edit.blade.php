@extends('layouts.app')
@section('content')
   {!! Breadcrumbs::render('ekintzakEdit', $ekintza) !!}
   <div class="panel panel-default">
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
		<div class="panel-body">
			<div class="col-sm-12 margin-tb">
		        <div class="pull-left">
		        	@if( $ekintza->tipo == 'laguntza' )
						<h2>{{ __('Bidelaguntza') }}</h2>
					@else
						<h2>{{ __('Formakuntza Osagarriak') }}</h2>
					@endif
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('ekintzak.index', ['tipo'  => $ekintza->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			{!! Form::model($ekintza, ['method' => 'PUT','route' => ['ekintzak.update', $ekintza->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Izenburua (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo:</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Deskripzioa (*):</strong></label>
		                {!! Form::textarea('desc_eu', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Descripción:</strong></label>
		                {!! Form::textarea('desc_es', null, array('placeholder' => 'Descripción','class' => 'form-control summernote')) !!}
		            </div>

		        </div>
		    </div>
		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Data') }} (*):</strong>  </label>
		                {!! Form::text('fecha',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>

		    </div>
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				{{ Form::hidden('tipo', $ekintza->tipo) }}
				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

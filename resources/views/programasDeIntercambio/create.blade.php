@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('programasDeIntercambio', $tipo) !!}
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
    	           	@if( $tipo == 'fuera' )
    					<h2>{{ __('Egonaldi zientifikoak beste Unibertsitateetan') }}</h2>
    				@elseif( $tipo == 'azp' )
    					<h2>{{ __('IIP / AZPren mugikortasuna') }}</h2>
    				@else
    					<h2>{{ __('Etorritako ikerlariak') }}</h2>
    				@endif
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('programasDeIntercambio.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>

        	{!! Form::open(array('route' => 'programasDeIntercambio.store','method'=>'POST', 'class'=>'form' )) !!}
        	<div>
        		<div class="col-sm-6 ">
                      <div class="form-group has-success">
                        <label><strong>Aktibitatea (*):</strong></label>
                        {!! Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )) !!}
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <div class="form-group">
                        <label><strong>Actividad :</strong></label>
                        {!! Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )) !!}
                    </div>
                </div>
            </div>
        	<div>
        		<div class="col-sm-6 ">
                      <div class="form-group has-success">
                        <label><strong>{{ __('Tokia') }} (*):</strong></label>
                        {!! Form::text('lugar', null, array('placeholder' => 'Aktibitea','class' => 'form-control')) !!}
                    </div>
                </div>

            </div>
            <div>
                <div class="col-sm-6 ">
                      <div class="form-group has-success">
                        <label><strong>{{ __('Noiztik') }} (*):</strong></label>
                        {!! Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
        		<div class="col-sm-6 ">
                    <div class="form-group">
                        <label><strong>{{ __('Arte') }} :</strong></label>
                        {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
            </div>
            <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
            <div>
                <div class="col-sm-12 col-sm-12 col-md-12 text-center">
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
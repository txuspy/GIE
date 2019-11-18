@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('proyectos', $tipo) !!}
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
    	            @if( $tipo == 'europa' )
    					<h2>{{ __('Europar Batasuneko Programa Markoa') }}</h2>
    				@elseif ($tipo == 'erakundeak')
    					<h2>{{ __('Erakundeek diruz lagundutako ikerkuntza Proiektuak') }}</h2>
       				@else
    					<h2>{{ __('Enpresek diruz lagundutako ikerkuntza Proiektuak') }}</h2>
    				@endif
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('proyectos.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>

	{!! Form::open(array('route' => 'proyectos.store','method'=>'POST', 'class'=>'form' )) !!}
	<div>
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Proiektua')  }}  (*):</strong></label>
                @if ($errors->has('proyecto_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif

                {!! Form::text('proyecto_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
            </div>
        </div>
        <!--
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Proyecto:</strong></label>
                {!! Form::text('proyecto_es', null, array('placeholder' => 'Proyecto','class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)) !!}
            </div>
        </div>
        -->
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Finantziazioa')  }} (*):</strong></label>
                {!! Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')) !!}
            </div>
        </div>
    </div>

	<div>
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Noiztik') }} (*):</strong></label>
                @if ($errors->has('desde'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Noiz arte') }} :</strong></label>
                {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addYear('1')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
    </div>
    <div>

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
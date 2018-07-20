@extends('layouts.app')

@section('content')
    {!! Breadcrumbs::render('congresos') !!}
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
    	            <h2>{{ __('Kongresu Zientifikoetan parte-hartzea')}}</h2>
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('congresos.index') }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>
        	{!! Form::open(array('route' => 'congresos.store','method'=>'POST', 'class'=>'form' )) !!}
        	<div>
        		<div class="col-sm-6 ">
                    <div class="form-group has-success">
                        <label><strong>{{ _('Kongresua')}} (*):</strong></label>
                        {!! Form::text('congreso_eu', null, array('placeholder' => _('Kongresua') ,'class' => 'form-control buscadorCongresos')) !!}
                    </div>
                </div>
                <div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong>{{ ('Izenburua') }} (*):</strong></label>
                        {!! Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburua') ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div>
                <div class="col-sm-6 ">
                    <div class="form-group has-success">
                        <label><strong>{{ __('Ekarpen mota') }} (*):</strong></label>
                        {!! Form::select('ekarpena',  \App\Traits\Listados::listadoEkarpena(), '1', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}

                    </div>
                </div>
                 <div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong>{{ __('Tokia') }} (*):</strong></label>
                        {!! Form::text('lugar', null, array('placeholder' => __('Viena, Austria'),'class' => 'form-control')) !!}
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
                     <div class="form-group has-success">
                        <label><strong>{{ __('Arte') }} (*):</strong></label>
                        {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
            </div>
            <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
            <div class="row">
                <div class="col-sm-12 col-sm-12 col-md-12 text-center">
                   	<button type="submit" class="btn btn-success">
                        <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
                    </button>
                </div>
        	</div>

        	{{ Form::hidden('user_id', \Auth::user()->id) }}
        	{!! Form::close() !!}
        </div>
    </div>
@endsection
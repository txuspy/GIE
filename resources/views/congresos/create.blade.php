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
                    <div class="form-group has-error">
                        <label><strong>{{ _('Kongresua')}} (*):</strong></label>
                        @if ($errors->has('congreso_eu'))
                            <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                        @endif
                        {!! Form::text('congreso_eu', null, array('placeholder' => _('Kongresua') ,'class' => 'form-control buscadorCongresos')) !!}
                    </div>
                </div>
                <div class="col-sm-6 ">
                     <div class="form-group has-error">
                        <label><strong>{{ ('Izenburua') }} (*):</strong></label>
                        @if ($errors->has('conferenciaPoster'))
                            <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                        @endif
                        {!! Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburua') ,'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div>
                <div class="col-sm-6 ">
                    <div class="form-group has-error">
                        <label><strong>{{ __('Ekarpen mota') }} (*):</strong></label>
                        {!! Form::select('ekarpena',  \App\Traits\Listados::listadoEkarpena(), '1', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}

                    </div>
                </div>
                 <div class="col-sm-6 ">
                     <div class="form-group has-error">
                        <label><strong>Tokia / Lugar (*):</strong></label>
                         @if ($errors->has('lugar'))
                            <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                        @endif
                        {!! Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control')) !!}
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
                     <div class="form-group has-error">
                        <label><strong>{{ __('Noiz arte') }} (*):</strong></label>
                        @if ($errors->has('hasta'))
                            <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                        @endif
                        {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addYear('1')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
            </div>
             <div>
                <div class="col-sm-12">
                    <p ><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
                </div>
            </div>
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


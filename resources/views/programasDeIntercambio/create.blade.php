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
    	           	@if( $tipo == 'PIfuera' )
						<h2>{{ __('Beste unibertsitateetan') }}</h2>
					@elseif( $tipo == 'PIvisita' )
						<h2>{{ __('Bisitariak') }}</h2>
					@elseif( $tipo == 'CEfuera' )
						<h2>{{ __('Beste unibertsitateetan ') }}</h2>
					@else
						<h2>{{ __('Bisitariak') }}</h2>
					@endif
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('programasDeIntercambio.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>

        	{!! Form::open(array('route' => 'programasDeIntercambio.store','method'=>'POST', 'class'=>'form' )) !!}
        	<div>
        		<div class="col-sm-6 ">
                      <div class="form-group has-error">
                        <label><strong>Aktibitatea(*):</strong></label>
                        @if ($errors->has('actividad_eu'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
                        {!! Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control', 'data-tipo'  => $tipo )) !!}
                    </div>
                </div>

                <div class="col-sm-6 ">
                    <div class="form-group">
                        <label><strong>Actividad :</strong></label>
                        {!! Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control', 'data-tipo'  => $tipo )) !!}
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
                        {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addMonths(6)->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
            </div>

<div class="col-sm-6 ">
                      <div class="form-group has-error">
                        <label><strong>
                            @if( $tipo == 'enCasa' )
								{{ __('Jatorria') }}
							@else
								{{ __('Tokia') }}
							@endif
                             (*):</strong></label>
                        @if ($errors->has('lugar'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
                        {!! Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control')) !!}
                    </div>
                </div>
                <div>
                    <div class="col-sm-12">
                        <p ><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
                    </div>
                </div>
                 <div>
                <div class="col-sm-12 col-sm-12 col-md-12 text-center">
                    {{ Form::hidden('tipo', $tipo) }}
                    {{ Form::hidden('user_id', \Auth::user()->id) }}
        			<button type="submit" class="btn btn-success">
        			   <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
        		    </button>
                </div>
        	</div>
            </div>





        	{!! Form::close() !!}
        </div>
    </div>
@endsection
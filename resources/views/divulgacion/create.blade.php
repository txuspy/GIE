@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('divulgacion', $tipo) !!}
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
    	            @if( $tipo == 'prensa' )
                        <h2>{{ __('Prentsa') }}</h2>
                    @else
                        <h2>{{ __('Hedakuntza') }}</h2>
                    @endif
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('divulgacion.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>

	{!! Form::open(array('route' => 'divulgacion.store','method'=>'POST', 'class'=>'form' )) !!}
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
                @if( $tipo == 'prensa' )
            		<div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong>{{ __('Noiz arte') }} :</strong></label>
                            @if ($errors->has('hasta'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addWeek('1')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                        </div>
                    </div>
                @endif
            </div>
            @if( $tipo == 'prensa' )
            
                 <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong>{{ __('Ekitaldiaren webgunea') }} :</strong></label>
                            @if ($errors->has('web'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('web', null, array('placeholder' => 'Ekitaldiaren webgunea','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
                      
                        </div>
                    </div>
            	
                </div>
            <div class="row"></div>
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong>{{ __('Komunikabidean agertu da') }} :</strong></label>
                            @if ($errors->has('komunikabideetanPublikatua'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::select('komunikabideetanPublikatua',   [0 => __('Ez'), 1 => __('Bai') ],  1 ,   ['class' => 'form-control'] ) !!}
                        </div>
                    </div>
            	
                </div>
                <div class="row"></div>
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong>{{ __('Komunikabidea') }} :</strong></label>
                            @if ($errors->has('komunikabidea'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('komunikabidea', null, array('placeholder' => 'Komunikabidea','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
                        </div>
                    </div>
            		<div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong>{{ __('Komunikabidearen esteka') }} :</strong></label>
                           @if ($errors->has('komunikabideWeb'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('komunikabideWeb', null, array('placeholder' => 'Komunikabidearen esteka','class' => 'form-control ', 'data-tipo'  => $tipo)) !!}
                        </div>
                    </div>
                </div>
            @endif
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
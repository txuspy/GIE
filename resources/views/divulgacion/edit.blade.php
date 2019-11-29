@extends('layouts.app')
@section('content')
   {!! Breadcrumbs::render('divulgacionEdit', $divulgacion) !!}
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
		        	@if( $divulgacion->tipo == 'prensa' )
						<h2>{{ __('Hedabideak') }}</h2>
					@else
						<h2>{{ __('Ekitaldiak') }}</h2>
					@endif
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('divulgacion.index', ['tipo'  => $divulgacion->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			
			{!! Form::model($divulgacion, ['method' => 'PUT','route' => ['divulgacion.update', $divulgacion->id]]) !!}
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
			@if( $divulgacion->tipo == 'hedakuntza' )
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
		    @endif
		    <div class="row" style="margin:1px;">
                <div class="col-sm-6 ">
                     <div class="form-group">
                        <label><strong>{{ __('Data') }} (*):</strong>  </label>
		                {!! Form::text('fecha',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
                    </div>
                </div>
                @if( $divulgacion->tipo == 'prensa' )
            		<!--
            		<div class="col-sm-6 ">
                        <label><strong>{{ __('Noiz arte') }} :</strong></label>
				            {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addWeek('1')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                	
                    </div>
                    -->
                @endif
            </div>
            
		     @if( $divulgacion->tipo == 'prensa' )
            <!--
                 <div>
                    <div class="col-sm-6 ">
                         <div class="form-group">
                            <label><strong>{{ __('Ekitaldiaren webgunea') }} :</strong></label>
                            @if ($errors->has('web'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('web', null, array('placeholder' => 'Ekitaldiaren webgunea','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)) !!}
                      
                        </div>
                    </div>
            	
                </div>
            <div class="row"></div>
            
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group">
                            <label><strong>{{ __('Komunikabidean agertu da') }} :</strong></label>
                            @if ($errors->has('komunikabideetanPublikatua'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::select('komunikabideetanPublikatua',   [0 => __('Ez'), 1 => __('Bai') ],  1 ,   ['class' => 'form-control'] ) !!}
                        </div>
                    </div>
            	
                </div>
            -->
                <div class="row"></div>
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group">
                            <label><strong>{{ __('Komunikabidea') }} :</strong></label>
                            @if ($errors->has('komunikabidea'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('komunikabidea', null, array('placeholder' => 'Komunikabidea','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)) !!}
                        </div>
                    </div>
            		<div class="col-sm-6 ">
                         <div class="form-group">
                            <label><strong>{{ __('Komunikabidearen esteka') }} :</strong></label>
                           @if ($errors->has('komunikabideWeb'))
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            @endif
                            {!! Form::text('komunikabideWeb', null, array('placeholder' => 'Komunikabidearen esteka','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)) !!}
                        </div>
                    </div>
                </div>
            @endif
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				{{ Form::hidden('tipo', $divulgacion->tipo) }}
				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

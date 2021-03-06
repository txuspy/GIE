@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('formaciones', $tipo, $modo) !!}
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
	           		<h2>
						@if( $tipo == 'PDI' )
							{{  __('IRIen formakuntza-jarduerak') }}
						@else
							{{  __('AZKko formazioa') }}
						@endif
						@if( $modo )
							- {{  __('Jasotakoa') }}
						@else
							- {{  __('Emandakoa') }}
						@endif
					</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('formaciones.index', ['tipo'  => $tipo , 'modo'  => $modo]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
	        </div>

			{!! Form::open(array('route' => 'formaciones.store','method'=>'POST', 'class'=>'form' )) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong>{{ __('Ikastaroa') }} (*):</strong></label>
		                 @if ($errors->has('titulo_eu'))
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    @endif
		                {!! Form::text('titulo_eu', null, array('placeholder' =>  __('Ikastaroa') ,'class' => 'form-control', 'data-tipo'  => $tipo , 'data-modo'  => $modo)) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong>{{ __('Hasiera-Data') }} (*):</strong></label>
		                @if ($errors->has('fecha'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
		                {!! Form::text('fecha', null , array('placeholder' =>  \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d')  ,'class' => 'datepicker  form-control')) !!}
		            </div>
		        </div>
		       <!-- <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong> :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)) !!}
		            </div>
		        </div>-->
		    </div>
			@if( $modo == 'recibir' )
			    <div>
					<div class="col-sm-6 ">
			            <div class="form-group has-error">
			                <label><strong>Antolatzailea(k) (*):</strong></label>
			                @if ($errors->has('organizador_eu'))
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    @endif
			                {!! Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)) !!}
			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es) :</strong></label>
			                {!! Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)) !!}
			            </div>
			        </div>
			    </div>
			@endif
			<div>

				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} :</strong></label>
		                {!! Form::text('lugar', null, array('id' =>'lugar', 'placeholder' => 'UPV/EHU, Gipuzkoako Ingenieritza Eskola' ,'class' => 'form-control ')) !!}
		            </div>
		            <p><a class='btn btn-info lugar' data-valor="UPV/EHU, Gipuzkoako Ingeniaritza Eskola">UPV/EHU, Gipuzkoako Ingeniaritza Eskola</a>
		            <a class='btn btn-info lugar' data-valor="GIE-Donostia">GIE-Donostia</a>
		            <a class='btn btn-info lugar' data-valor="GIE-Eibar">GIE-Eibar</a>
		            <a class='btn btn-info lugar' data-valor="SAE/HELAZ ( UPV/EHU )">SAE/HELAZ ( UPV/EHU )</a>
		            <a class='btn btn-info lugar' data-valor="Gipuzkoako Campusa ( UPV/EHU )">Gipuzkoako Campusa ( UPV/EHU )</a></p>
		        </div>
				<script>
					$(".lugar").click(function() {
						$("#lugar").val( $(this).attr('data-valor') );
					});
				</script>
		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Iraupena') }} : </strong></label><small>(h)</small>
		                {!! Form::text('duracion', null, array('placeholder' => '10' ,'class' => 'form-control ')) !!}
		            </div>
		        </div>
		    </div>
		    <div>
                <div class="col-sm-12">
		    		<p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
		    	</div>
	    	</div>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">
		            {{ Form::hidden('tipo', $tipo) }}
		            {{ Form::hidden('modo', $modo) }}
		            {{ Form::hidden('user_id', \Auth::user()->id) }}
					<button type="submit" class="btn btn-success">
					   <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
				    </button>
		        </div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
    <script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
@endsection
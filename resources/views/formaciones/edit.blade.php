@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('formacionesEdit', $formacion) !!}
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
		           	<h2>
						@if( $formacion->tipo == 'PDI' )
							{{  __('IRIen formakuntza-jarduerak') }}
						@else
							{{  __('AZKko formazioa') }}
						@endif
						@if( $formacion->modo == 'recibir' )
							- {{  __('Jasotakoa') }}
						@else
							- {{  __('Emandakoa') }}
						@endif
					</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('formaciones.index', ['tipo'  => $formacion->tipo, 'modo'  => $formacion->modo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogFormacionesAutores",
				'idForm'=>'formdialogFormacionesAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			])

			{!! Form::model($formacion, ['method' => 'PUT','route' => ['formaciones.update', $formacion->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Ikastaroa') }} (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Hasiera-Data') }} (*) :</strong></label>
		                {!! Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker  form-control')) !!}
		            </div>
		        </div>
		    </div>
		    @if( $formacion->modo == 'recibir' )
			     <div>
					<div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Antolatzailea(k) (*):</strong></label>
			                {!! Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control buscadorformaciones')) !!}
			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es):</strong></label>
			                {!! Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control buscadorformaciones')) !!}
			            </div>
			        </div>
			    </div>
			@endif
			<div>

				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} :</strong></label>
		                {!! Form::text('lugar', null, array('id' =>'lugar','placeholder' => __('Tokia') ,'class' => 'form-control ')) !!}
			            <p><a class='btn btn-info lugar' data-valor="UPV/EHU, Gipuzkoako Ingenieritza Eskola">UPV/EHU, Gipuzkoako Ingenieritza Eskola</a>
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

		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Iraupena') }} :</strong></label><small>(h)</small>
		                {!! Form::text('duracion', null, array('placeholder' => __('Iraupena') ,'class' => 'form-control ')) !!}
		            </div>
		        </div>
		    </div>

		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>
		    				@if( $formacion->modo == 'recibir' )
								{{ __('Parte-hartzailea(k)') }} (*)
							@else
								{{ __('Hizlaria(k)') }} (*)
							@endif
						</strong><span class='autorInfo'></span></label>
		    	 	{{Form::text('formacionesAutores', '', [
				        'id'           =>'formacionesAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogFormacionesAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'formaciones',
				        'data-idUl'    =>'ulFormacionesAutores',
				        'data-id'      => $formacion->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulFormacionesAutores" class="list-group">
			 			@foreach( $formacion->autores as $autor)
			 				<li class="list-group-item" id="detachAutores{{ $autor->id }}">
				 				<a data-id='{{$formacion->id}}' data-idAutor='{{ $autor->id }}' data-carpeta ='autores' data-tipo='formaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$autor->nombre}} {{$autor->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	{{ Form::hidden('tipo', $formacion->tipo) }}
		        	{{ Form::hidden('modo', $formacion->modo) }}
					<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
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

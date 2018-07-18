@extends('layouts.app')
@section('content')
   {!! Breadcrumbs::render('programasDeIntercambioEdit', $programaDeIntercambio) !!}
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
		           	@if( $programaDeIntercambio->tipo == 'fuera' )
						<h2>{{ __('Egonaldi zientifikoak beste Unibertsitateetan') }}</h2>
					@elseif( $programaDeIntercambio->tipo  == 'azp' )
						<h2>{{ __('IIP / AZPren mugikortasuna') }}</h2>
					@else
						<h2>{{ __('Etorritako ikerlariak') }}</h2>
					@endif
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('programasDeIntercambio.index', ['tipo'  => $programaDeIntercambio->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogProgramaDeIntercambioProfesores",
				'idForm'=>'formdialogProgramaDeIntercambioProfesores',
				'tituloContenido' => __('Irakaslea berria sortu') ,
			])

			{!! Form::model($programaDeIntercambio, ['method' => 'PUT','route' => ['programasDeIntercambio.update', $programaDeIntercambio->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Aktibitatea:</strong></label>
		                {!! Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad:</strong></label>
		                {!! Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control')) !!}
		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} :</strong></label>
		                {!! Form::text('lugar', null, array('placeholder' => __('Tokia') ,'class' => 'form-control')) !!}
		            </div>
		        </div>


		        <div class="col-sm-3">
		            <div class="form-group">
		                <label><strong>{{ __('Noiztik') }} :</strong></label>
		                {!! Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
				<div class="col-sm-3">
		            <div class="form-group">
		                <label><strong>{{ __('Arte') }} :</strong></label>
		                {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>{{ __('Irakaslea(k)')}}:</strong></label>
		    	 	{{Form::text('programaDeIntercambioProfesores', '', [
				        'id'           =>'programaDeIntercambioProfesores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogProgramaDeIntercambioProfesores',
				        'data-carpeta' =>'profesor',
				        'data-tipo'    =>'programasDeIntercambio',
				        'data-idUl'    =>'ulProgramaDeIntercambioProfesores',
				        'data-id'      => $programaDeIntercambio->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulProgramaDeIntercambioProfesores" class="list-group">
			 			@foreach( $programaDeIntercambio->profesores as $profesor)
			 				<li class="list-group-item" id="detachProfesores{{ $profesor->id }}">
				 				<a data-id='{{$programaDeIntercambio->id}}' data-idAutor='{{ $profesor->id }}' data-carpeta ='profesor' data-tipo='programasDeIntercambio'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$profesor->nombre}} {{$profesor->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>
			</div>
	        <div class="col-sm-10 col-sm-10 col-md-10 text-center">
	        	{{ Form::hidden('tipo', $programaDeIntercambio->tipo) }}
				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
	        </div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

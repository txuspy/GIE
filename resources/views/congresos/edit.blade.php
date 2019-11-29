@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('congresosEdit', $congreso) !!}
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
		            <h2>{{ __('Kongresu zientifikoetan parte-hartzea')}}</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('congresos.index') }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
    	</div>
		@include('layouts.dialog', [
			'idDialog' => "dialogCongresoProfesor",
			'idForm'=>'formdialogCongresoProfesor',
			'tituloContenido' => __('Irakasle berria sortu') ,
		])

		{!! Form::model($congreso, ['method' => 'PATCH','route' => ['congresos.update', $congreso->id]]) !!}
		<div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong>{{ __('Kongresua') }}:</strong></label>
	                {!! Form::text('congreso_eu', null, array('placeholder' => 'Grupo','class' => 'form-control')) !!}
	            </div>
	        </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong>{{ __('Izenburua') }} :</strong></label>
	                {!! Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburuaa') ,'class' => 'form-control')) !!}
	            </div>
	        </div>
	    </div>
		<div>
			<div class="col-xs-6 ">
		      	 <div class="form-group has-error">
		                <label><strong>{{ __('Ekarpen mota') }} (*):</strong></label>

		                {!! Form::select('ekarpena',  \App\Traits\Listados::listadoEkarpena(), $congreso->ekarpena , ['id' =>'ekarpena',   'class' => 'form-control chosen-select'])  !!}

		         </div>
	         </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong>{{ __('Tokia') }} :</strong></label>
	                {!! Form::text('lugar', null, array('placeholder' => __('Viena, Austria'),'class' => 'form-control')) !!}
	            </div>
	        </div>
	    </div>
	    <div>
	        <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong>{{ __('Noiztik') }} :</strong></label>
	                {!! Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
	            </div>
	        </div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong>{{ __('Noiz arte') }} :</strong></label>
	                {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
	            </div>
	        </div>
	    </div>

	    <div>
	    	<div class="col-md-6 ">
	    		<label><strong>{{ __('Irakaslea(k)')}}:</strong><span class='autorInfo'></span></label>
	    	 	{{Form::text('CongresoProfesor', '', [
			        'id'           =>'CongresoProfesor',
			        'placeholder'  =>__('Irakaslea bilatu'),
			        'class'        =>'form-control buscadorAutor inputAutores',
			        'data-idDialog'=>'dialogCongresoProfesor',
			        'data-carpeta' =>'profesor',
			        'data-tipo'    =>'congresos',
			        'data-idUl'    =>'ulCongresoProfesor',
			        'data-id'      => $congreso->id
	    	 	]
	    	 	)}}
		 		<br><ul id="ulCongresoProfesor" class="list-group">
		 			@foreach( $congreso->profesores as $profesor)
		 				<li class="list-group-item" id="detachProfesor{{ $profesor->id }}">
			 				<a data-id='{{$congreso->id}}' data-idAutor='{{ $profesor->id }}' data-carpeta ='profesor' data-tipo='congresos'  class='desenlazar'>
			 					<i class="fa fa-trash"></i>
			 				</a>
		 				{{$profesor->nombre}} {{$profesor->apellido}}
		 				</li>
		 			@endforeach
		 		</ul>
		 	</div>

		</div>
	    <div class="col-md-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
		</div>
		{!! Form::close() !!}
	</div>
@endsection

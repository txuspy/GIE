@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('visitasEdit', $visita) !!}
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
		           	<h2>{{ __('Instalazio bisitak') }}</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('visitas.index' ) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogVisitasAutores",
				'idForm'=>'formdialogVisitasAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			])

			{!! Form::model($visita, ['method' => 'PUT','route' => ['visitas.update', $visita->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Aktibitatea (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad:</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')) !!}
		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} (*):</strong></label>
		                {!! Form::text('lugar', null , array('placeholder' => __('Tokia') ,'class' => ' form-control')) !!}
		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Data') }} (*):</strong></label>
		                {!! Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
		    </div>

		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>{{ __('Irakaslea(k)')}} (*):</strong><span class='autorInfo'></span></label>
		    	 	{{Form::text('visitasAutores', '', [
				        'id'           =>'visitasAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogVisitasAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'visitas',
				        'data-idUl'    =>'ulVisitasAutores',
				        'data-id'      => $visita->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulVisitasAutores" class="list-group">
			 			@foreach( $visita->autores as $autor)
			 				<li class="list-group-item" id="detachAutores{{ $autor->id }}">
				 				<a data-id='{{$visita->id}}' data-idAutor='{{ $autor->id }}' data-carpeta ='autores' data-tipo='publicaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$autor->nombre}} {{$autor->apellido}}
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
	</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
@endsection

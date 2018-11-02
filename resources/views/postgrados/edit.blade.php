@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('postgradosEdit', $postgrado) !!}
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
		           	@if( $postgrado->tipo == 'master' )
						<h2>{{ __('Masterretan parte-hartzea') }}</h2>
					@else
						<h2>{{ __('Doktoretza-programetan parte-hartzea') }}</h2>
					@endif
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('postgrados.index', ['tipo'  => $postgrado->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogPostgradosAutores",
				'idForm'=>'formdialogPostgradosAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			])

			{!! Form::model($postgrado, ['method' => 'PUT','route' => ['postgrados.update', $postgrado->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Programa') }} :</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Ikastaroa') }}:</strong></label>
		                {!! Form::text('curso_eu', null, array('placeholder' => 'Ikastaroa','class' => 'form-control')) !!}
		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		           <div class="form-group">
		                <label><strong>{{ __('Saila') }} (*):</strong></label>
		                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $postgrado->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Iraupena') }}(*):</strong></label>
		                {!! Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
		            </div>
		        </div>
		    </div>
		    <div class="row" style="margin:1px;">
		       <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} (*):</strong></label>
		                {!! Form::text('lugar', 'Gipuzkoako Ingeniaritza Eskola', array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Hasiera Data') }} (*):</strong></label>
		                {!! Form::text('fecha', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')) !!}
		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>{{ __('Irakaslea(k)')}} (*): <span id='autorInfo'></span></strong></label>
		    	 	{{Form::text('postgradosAutores', '', [
				        'id'           =>'postgradosAutores',
				        'placeholder'  =>__('Irakaslea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogPostgradosAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'postgrados',
				        'data-idUl'    =>'ulPostgradosAutores',
				        'data-id'      => $postgrado->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulPostgradosAutores" class="list-group">
			 			@foreach( $postgrado->autores as $autor)
			 				<li class="list-group-item" id="detachAutores{{ $autor->id }}">
				 				<a data-id='{{$postgrado->id}}' data-idAutor='{{ $autor->id }}' data-carpeta ='autores' data-tipo='postgrado'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$autor->nombre}} {{$autor->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	{{ Form::hidden('tipo', $postgrado->tipo) }}
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

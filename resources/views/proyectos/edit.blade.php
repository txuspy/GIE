@extends('layouts.app')
@section('content')
   {!! Breadcrumbs::render('proyectosEdit', $proyecto) !!}
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
		        	@if( $proyecto->tipo == 'europa' )
						<h2>{{ __('Europar Batasuneko Programa Markoa') }}</h2>
					@elseif ($proyecto->tipo == 'erakundeak')
						<h2>{{ __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
		   			@else
						<h2>{{ __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak') }}</h2>
					@endif
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('proyectos.index', ['tipo'  => $proyecto->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

			@include('layouts.dialog', [
				'idDialog' => "dialogProyectosDirector",
				'idForm'=>'formdialogProyectosDirector',
				'tituloContenido' => __('Zuzendari berria sortu') ,
			])
			@include('layouts.dialog', [
				'idDialog' => "dialogProyectosInvestigador",
				'idForm'=>'formdialogProyectosInvestigador',
				'tituloContenido' => __('Doctorando berria sortu') ,
			])
			{!! Form::model($proyecto, ['method' => 'PUT','route' => ['proyectos.update', $proyecto->id]]) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Proiektua:</strong></label>
		                {!! Form::text('proyecto_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Proyecto:</strong></label>
		                {!! Form::text('proyecto_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Finantziazioa') }} :</strong></label>
		                {!! Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')) !!}
		            </div>
		        </div>
				<div style="clear:both;"></div>
		    </div>
		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Noiztik') }} :</strong> ( {{$periodo}} )</label>
		                {!! Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Arte') }} :</strong></label>
		                {!! Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>{{ __('Ikertzaile nagusia')}}:</strong></label>
		    	 	{{Form::text('proyectosDirector', '', [
				        'id'           =>'proyectosDirector',
				        'placeholder'  =>__('Ikertzaile nagusia bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogProyectosDirector',
				        'data-carpeta' =>'director',
				        'data-tipo'    =>'proyectos',
				        'data-idUl'    =>'ulProyectosDirector',
				        'data-id'      => $proyecto->id
		    	 	]
		    	 	)}}
			 		<br><ul id="ulProyectosDirector" class="list-group">
			 			@foreach( $proyecto->directores as $director)
			 				<li class="list-group-item" id="detachDirector{{ $director->id }}">
				 				<a data-id='{{$proyecto->id}}' data-idAutor='{{ $director->id }}' data-carpeta ='director' data-tipo='proyectos'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				{{$director->nombre}} {{$director->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>
			 	<div class="col-sm-6 ">
		    		<label><strong>{{ __('Partaideak')}}:</strong></label>
		    	 	{{Form::text('proyectosInvestigador', '', [
			         'id'           =>'proyectosInvestigador',
			         'placeholder'  =>__('Partaideak bilatu'),
			         'class'        =>'form-control buscadorAutor inputAutores' ,
			         'data-idDialog'=>'dialogProyectosInvestigador',
			         'data-carpeta' =>'doctorando',
			         'data-tipo'    =>'proyectos',
			         'data-idUl'    =>'ulProyectosInvestigador',
			         'data-id'      => $proyecto->id
			        ])}}
			 		<br><ul id="ulProyectosInvestigador" class="list-group">
			 			@foreach( $proyecto->investigadores as $investigador)
			 				<li class="list-group-item"  id="detachDoctorando{{ $investigador->id }}">
			 					<a data-id='{{$proyecto->id}}' data-idAutor='{{ $investigador->id }}' data-carpeta ='doctorando' data-tipo='proyectos'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 					{{$investigador->nombre}} {{$investigador->apellido}}
			 				</li>
			 			@endforeach
			 		</ul>
			 	</div>
		 	</div>
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				{{ Form::hidden('tipo', $proyecto->tipo) }}
				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection

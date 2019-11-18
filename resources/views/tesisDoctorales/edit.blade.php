@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('tesisDoctoralesEdit', $tesisDoctoral) !!}
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
		            <h2>{{ __('Tesiak')}}</h2>
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('tesisDoctorales.index', ['tipo'  => $tesisDoctoral->tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
		    </div>

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
	@include('layouts.dialog', [
		'idDialog' => "dialogTesisDoctoralesDirector",
		'idForm'=>'formdialogTesisDoctoralesDirector',
		'tituloContenido' => __('Zuzendari berria sortu') ,
	])
	@include('layouts.dialog', [
		'idDialog' => "dialogTesisDoctoralesDoctorando",
		'idForm'=>'formdialogTesisDoctoralesDoctorando',
		'tituloContenido' => __('Doctorando berria sortu') ,
	])
	{!! Form::model($tesisDoctoral, ['route' => ['tesisDoctorales.update', $tesisDoctoral->id] ]) !!}
	<input name="_method" type="hidden" value="PUT">
		<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Izenburua') }}:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>
        <!--<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>-->
    </div>
	<div>
		<div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>{{ __('Saila') }}(*):</strong></label>
                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $tesisDoctoral->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
            </div>
        </div>
		<div class="col-sm-3">
            {{ Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('euskera', 1, $tesisDoctoral->euskera, ['class' => '']) }}
        </div>
        <div class="col-sm-3">
           {{ Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('internacional', 1, $tesisDoctoral->internacional, ['class' => '']) }}
        </div>
	</div>


	<div class='row'>
		<div style="margin:30px;">
			@if($tesisDoctoral->tipo=='tesisLeidas')
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>{{ __('Data') }} {{ $tesisDoctoral->fechaLectura }}:</strong></label>
			                {!! Form::text('fechaLectura', $tesisDoctoral->fechaLectura , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
			            </div>
			        </div>
			    </div>
			    <div class="col-sm-6 "> </div>
		    @endif
		    @if($tesisDoctoral->tipo=='proximaLectura')
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>{{ __('Kurtsoa') }} :</strong></label>
			                <span><i>( {{ $tesisDoctoral->curso }} - {{ $tesisDoctoral->curso +1 }} )</i></span>
			                {!! Form::text('curso', $tesisDoctoral->curso , array('placeholder' => __('Kurtsoa') ,'class' => 'form-control')) !!}
			            </div>
			        </div>
			    </div><div class="col-sm-6 "> </div>
		    @endif
		</div>
	</div>


    <div>
    	<div class="col-sm-6">
    		<label><strong>{{ __('Zuzendaria(k)')}} (*):</strong><span class='autorInfo'></span></label>
    	 	{{Form::text('tesisDoctoralesDirector', '', [
		        'id'           =>'tesisDoctoralesDirector',
		        'placeholder'  =>__('Zuzendaria bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogTesisDoctoralesDirector',
		        'data-carpeta' =>'director',
		        'data-tipo'    =>'tesisDoctorales',
		        'data-idUl'    =>'ulTesisDoctoralesDirector',
		        'data-id'      => $tesisDoctoral->id
    	 	]
    	 	)}}
	 		<br><ul id="ulTesisDoctoralesDirector" class="list-group">
	 			@foreach( $tesisDoctoral->directores as $director)
	 				<li class="list-group-item" id="detachDirector{{ $director->id }}">
		 				<a data-id='{{$tesisDoctoral->id}}' data-idAutor='{{ $director->id }}' data-carpeta ='director' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$director->nombre}} {{$director->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	 	<div class="col-sm-6 ">
    		<label><strong>{{ __('Ikerlaria(k)')}} (*):</strong></label>
    	 	{{Form::text('tesisDoctoralesDoctorando', '', [
	         'id'           =>'tesisDoctoralesDoctorando ',
	         'placeholder'  =>__('Doktorandoa bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogTesisDoctoralesDoctorando',
	         'data-carpeta' =>'doctorando',
	         'data-tipo'    =>'tesisDoctorales',
	         'data-idUl'    =>'ulTesisDoctoralesDoctorando',
	         'data-id'      => $tesisDoctoral->id
	        ])}}
	 		<br><ul id="ulTesisDoctoralesDoctorando" class="list-group">
	 			@foreach( $tesisDoctoral->doctorandos as $doctorando)
	 				<li class="list-group-item"  id="detachDoctorando{{ $doctorando->id }}">
	 					<a data-id='{{$tesisDoctoral->id}}' data-idAutor='{{ $doctorando->id }}' data-carpeta ='doctorando' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					{{$doctorando->nombre}} {{$doctorando->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	</div>
	<div class="col-md-12 col-sm-12 col-md-12 text-center">
		{{ Form::hidden('tipo', $tesisDoctoral->tipo) }}
		<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
    </div>
	{!! Form::close() !!}
</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
@endsection
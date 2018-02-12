@extends('layouts.app')
@section('content')
<div class="container">
   {!! Breadcrumbs::render('grupoInvestigacionEdit', $grupoInvestigacion) !!}
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
		'idDialog' => "dialogGrupoInvestigacionResponsable",
		'idForm'=>'formdialogGrupoInvestigacionResponsable',
		'tituloContenido' => __('Arduradun berria sortu') ,
	])
	@include('layouts.dialog', [
		'idDialog' => "dialogGrupoInvestigacionParticipante",
		'idForm'=>'formdialogGrupoInvestigacionParticipante',
		'tituloContenido' => __('Partaide berria sortu') ,
	])

	{!! Form::model($grupoInvestigacion, ['method' => 'PATCH','route' => ['grupoInvestigacion.update', $grupoInvestigacion->id]]) !!}
	<div class="row">
		<div class="col-md-6 ">
            <div class="form-group">
                <label><strong>Taldea:</strong></label>
                {!! Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-md-6 ">
            <div class="form-group">
                <label><strong>Grupo:</strong></label>
                {!! Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control')) !!}
            </div>
        </div>

    </div>
	<div class="row">
		 <div class="col-md-6 ">
            <div class="form-group">
                <label><strong>Ikerkuntza lerroak :</strong></label>
                {!! Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="form-group">
                <label><strong>Líneas de investigación :</strong></label>
                {!! Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control')) !!}
            </div>
        </div>

    </div>

    <div class="row">
    	<div class="col-md-6 ">
    		<label><strong>{{ __('Arduraduna')}}:</strong></label>
    	 	{{Form::text('grupoInvestigacionResponsable', '', [
		        'id'           =>'grupoInvestigacionResponsable',
		        'placeholder'  =>__('Arduraduna bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogGrupoInvestigacionResponsable',
		        'data-carpeta' =>'responsable',
		        'data-tipo'    =>'grupoInvestigacion',
		        'data-idUl'    =>'ulGrupoInvestigacionResponsables',
		        'data-id'      => $grupoInvestigacion->id
    	 	]
    	 	)}}
	 		<br><ul id="ulGrupoInvestigacionResponsables" class="list-group">
	 			@foreach( $grupoInvestigacion->responsables as $responsable)
	 				<li class="list-group-item" id="detachResponsable{{ $responsable->id }}">
		 				<a data-id='{{$grupoInvestigacion->id}}' data-idAutor='{{ $responsable->id }}' data-carpeta ='responsable' data-tipo='grupoInvestigacion'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				{{$responsable->nombre}} {{$responsable->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	 	<div class="col-md-6 ">
    		<label><strong>{{ __('Partaideak')}}:</strong></label>
    	 	{{Form::text('grupoInvestigacionParticipante', '', [
	         'id'           =>'grupoInvestigacionParticipante ',
	         'placeholder'  =>__('Partaidea bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogGrupoInvestigacionParticipante',
	         'data-carpeta' =>'participante',
	         'data-tipo'    =>'grupoInvestigacion',
	         'data-idUl'    =>'ulGrupoInvestigacionParticipantes',
	         'data-id'      => $grupoInvestigacion->id
	        ])}}
	 		<br><ul id="ulGrupoInvestigacionParticipantes" class="list-group">
	 			@foreach( $grupoInvestigacion->participantes as $participante)
	 				<li class="list-group-item" id="detachParticipante{{ $responsable->id }}">
	 					<a data-id='{{$grupoInvestigacion->id}}' data-idAutor='{{ $participante->id }}' data-carpeta ='participante' data-tipo='grupoInvestigacion'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					{{$participante->nombre}} {{$participante->apellido}}
	 				</li>
	 			@endforeach
	 		</ul>
	 	</div>
	</div>
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 ">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	{!! Form::close() !!}
	</div>
@endsection

@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('grupoInvestigacion') !!}
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
                	<h2>{{ __('Ikerkuntza taldea') }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('grupoInvestigacion.index') }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
                </div>
            </div>
        	{!! Form::open(array('route' => 'grupoInvestigacion.store','method'=>'POST', 'class'=>'form' )) !!}
            	<div>
            	     <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>Taldea (*):</strong></label>
                             @if ($errors->has('grupo_eu'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control buscadorGrupoInvestigacion')) !!}
                        </div>
                    </div>
            		<div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Grupo:</strong></label>
                            {!! Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control buscadorGrupoInvestigacion')) !!}
                        </div>
                    </div>

                </div>
            	<div>

                     <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>Ikerkuntza lerroak (*):</strong></label>
                            @if ($errors->has('lineasInv_eu'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control summernote')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Líneas de investigación :</strong></label>
                            {!! Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control summernote')) !!}
                        </div>
                    </div>
                </div>


                <div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Noiztik') }} (*):</strong></label>
                            @if ($errors->has('desde'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d'),'class' => 'date-year form-control')) !!}
                        </div>
                    </div>
            		<div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Arte') }} :</strong></label>
                            {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addYear('1')->format('Y-m-d') ,'class' => 'date-year form-control')) !!}
                        </div>
                    </div>
                </div>
                 <div>
                        <div class="col-sm-12">
                            <p ><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
                        </div>
                    </div>
                <div>
                    <div class="col-md-12 col-sm-12 col-md-12 text-center">
            			<button type="submit" class="btn btn-success">
            			   <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
            		    </button>
                    </div>
            	</div>
        	{{ Form::hidden('user_id', \Auth::user()->id) }}
        	{!! Form::close() !!}
        </div>
    </div>
    <script type="text/javascript">
      $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
    </script>
@endsection
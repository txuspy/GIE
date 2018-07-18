@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('equipamientoNuevo') !!}
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
                	<h2>{{ __('Hornikuntza Zientifikoa eskuratzea') }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('equipamientoNuevo.index') }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
                </div>
            </div>
	        {!! Form::open(array('route' => 'equipamientoNuevo.store','method'=>'POST', 'class'=>'form' )) !!}
        	    <div>
            		<div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>Hornikuntza (*):</strong></label>
                            {!! Form::text('equipo_eu', null, array('placeholder' => 'Hornikuntza','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Equipamiento:</strong></label>
                            {!! Form::text('equipo_es', null, array('placeholder' => 'Equipamiento','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            	<div>
            		<div class="col-sm-6 ">
                       <div class="form-group has-success">
                            <label><strong>Saila/ Departamento (*):</strong></label>
                            {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>{{ __('Instituzioa') }} (*):</strong></label>
                            {!! Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            	<div>

                    <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>{{ __('Data') }} (*):</strong></label>
                            {!! Form::text('data',  null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Zenbateko') }} :</strong></label>
                            {!! Form::text('importe', null, array('placeholder' => __('Zenbateko'),'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                 <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
                <div>
                    <div class="col-sm-12 col-sm-12 col-md-12 text-center">
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
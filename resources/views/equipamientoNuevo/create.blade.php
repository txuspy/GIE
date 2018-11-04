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
                        <div class="form-group has-error">
                            <label><strong>{{ __('Hornikuntza') }} (*):</strong></label>
                            @if ($errors->has('hornikuntza'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('hornikuntza', null, array('placeholder' => __('Hornikuntza')  ,'class' => 'form-control buscadorEquipamientoNuevo')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Ekipamendua') }} :</strong></label>
                            {!! Form::text('ekipamendua', null, array('placeholder' => __('Ekipamendua'),'class' => 'form-control buscadorEquipamientoNuevo')) !!}
                        </div>
                    </div>
                </div>
            	<div>
            		<div class="col-sm-6 ">
                       <div class="form-group has-error">
                            <label><strong>{{ __('Saila') }} (*):</strong></label>
                            {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Instituzioa') }} (*):</strong></label>
                            @if ($errors->has('institucion'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            	<div>

                    <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Data') }} (*):</strong></label>
                            @if ($errors->has('data'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('data',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y') ,'class' => 'datepicker date-year form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Zenbateko') }} :</strong><small>(€)</small></label>
                            {!! Form::text('importe', null, array('placeholder' => 15000,'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            	<div>

                    <div class="col-sm-12 ">
                     <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
                     </div>
                </div>
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
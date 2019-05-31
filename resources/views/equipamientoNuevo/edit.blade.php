@extends('layouts.app')
@section('content')

   {!! Breadcrumbs::render('equipamientoNuevoEdit', $equipamientoNuevo) !!}
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
                	<h2>{{ __('Hornikuntza Zientifikoa eskuratzea') }}</h2>
                </div>
                <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('equipamientoNuevo.index') }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
                </div>
            </div>

	{!! Form::model($equipamientoNuevo, ['method' => 'PATCH','route' => ['equipamientoNuevo.update', $equipamientoNuevo->id]]) !!}
	<div>

        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Hornikuntza') }}:</strong></label>
                {!! Form::text('hornikuntza', null, array('placeholder' => 'Taldea','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Ekipamendua') }}:</strong></label>
                {!! Form::text('ekipamendua', null, array('placeholder' => 'Equipo','class' => 'form-control')) !!}
            </div>
        </div>

    </div>
    <div>

        <div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>{{ __('Saila') }} :</strong></label>
                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $equipamientoNuevo->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Instituzioa') }} :</strong></label>
                {!! Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div>
	    <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Data') }} :</strong></label>
                {!! Form::text('data',  null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>

         <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Zenbateko') }} :</strong><small>(€)</small></label>
                {!! Form::text('importe', null, array('placeholder' => __('Zenbateko'),'class' => 'form-control')) !!}
            </div>
        </div>
    </div>

    <div>
    <div class="col-md-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="{{ __('Gorde') }}"></i> {{ __('Gorde') }}</button>
    </div>
	{!! Form::close() !!}
	</div>
		</div>	</div>
	<script type="text/javascript">
      $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
    </script>
@endsection

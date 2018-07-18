@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('visitas' ) !!}
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

					<h2>{{ __('Bisitak') }}</h2>

		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('visitas.index' ) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
	        </div>

			{!! Form::open(array('route' => 'visitas.store','method'=>'POST', 'class'=>'form' )) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>Aktibitatea (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Aktibitatea','class' => 'form-control buscadorVisitas')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Actividad','class' => 'form-control buscadorVisitas')) !!}
		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>{{ __('Tokia') }} (*):</strong></label>
		                {!! Form::text('lugar', null , array('placeholder' => __('Tokia') ,'class' => 'datepicker date-year form-control')) !!}
		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>{{ __('Data') }} (*):</strong></label>
		                {!! Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')) !!}
		            </div>
		        </div>
		    </div>
		    <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">

		            {{ Form::hidden('user_id', \Auth::user()->id) }}
					<button type="submit" class="btn btn-success">
					   <i class="fa fa-plus" title ="{{ __('Jarraitu') }}"></i>  {{ __('Jarraitu') }}
				    </button>
		        </div>
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
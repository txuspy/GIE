@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('publicaciones', $tipo) !!}
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
		           	@if( $tipo == 'libros' )
						<h2>{{ __('Liburuak eta Monografiak') }}</h2>
					@else
						<h2>{{ __('Artikuloak') }}</h2>
					@endif
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('publicaciones.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
	        </div>

			{!! Form::open(array('route' => 'publicaciones.store','method'=>'POST', 'class'=>'form' )) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>Izenburua (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control buscadorPublicaciones', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorPublicaciones', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>{{ __('Data') }} (*):</strong></label>
		                {!! Form::text('year', null , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')) !!}
		            </div>
		        </div>
		    </div>
		    <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">
		            {{ Form::hidden('tipo', $tipo) }}
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
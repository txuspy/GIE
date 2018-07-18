@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('formaciones', $tipo, $modo) !!}
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
		            <a class="btn btn-primary" href="{{ route('formaciones.index', ['tipo'  => $tipo , 'modo'  => $modo]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
	        </div>

			{!! Form::open(array('route' => 'formaciones.store','method'=>'POST', 'class'=>'form' )) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>Izenburua (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control buscadorFormaciones')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorFormaciones')) !!}
		            </div>
		        </div>
		    </div>
			@if( $modo == 'recibir' )
			    <div>
					<div class="col-sm-6 ">
			            <div class="form-group has-success">
			                <label><strong>Antolatzailea(k) (*):</strong></label>
			                {!! Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control buscadorFormaciones')) !!}
			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es) :</strong></label>
			                {!! Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control buscadorFormaciones')) !!}
			            </div>
			        </div>
			    </div>
			@endif
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>{{ __('Data') }} (*):</strong></label>
		                {!! Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker  form-control')) !!}
		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Tokia') }} :</strong></label>
		                {!! Form::text('lugar', null, array('placeholder' => __('Tokia') ,'class' => 'form-control ')) !!}
		            </div>
		        </div>

		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Iraupena') }} :</strong></label>
		                {!! Form::text('duracion', null, array('placeholder' => __('Iraupena') ,'class' => 'form-control ')) !!}
		            </div>
		        </div>
		    </div>
		    <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">
		            {{ Form::hidden('tipo', $tipo) }}
		            {{ Form::hidden('modo', $modo) }}
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
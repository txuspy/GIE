@extends('layouts.app')
@section('content')
    {!! Breadcrumbs::render('postgrados', $tipo) !!}
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
		           	@if( $tipo == 'master' )
						<h2>{{ __('Masterretan parte-hartzea') }}</h2>
					@else
						<h2>{{ __('Doktoretza-programetan parte-hartzea') }}</h2>
					@endif
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="{{ route('postgrados.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
		        </div>
	        </div>

			{!! Form::open(array('route' => 'postgrados.store','method'=>'POST', 'class'=>'form' )) !!}
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>Programa (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorPostgrados')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Programa :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control buscadorPostgrados')) !!}
		            </div>
		        </div>
		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>Kurtsoa (*):</strong></label>
		                {!! Form::text('curso_eu', null, array('placeholder' => 'Kurtsoa','class' => 'form-control buscadorPostgrados')) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Curso :</strong></label>
		                {!! Form::text('curso_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorPostgrados')) !!}
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
		                <label><strong>{{ __('Iraupena') }} (*):</strong></label>
		                {!! Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
		            </div>
		        </div>
		    </div>
		    <div>

                <div class="col-sm-6 ">
		            <div class="form-group has-success">
		                <label><strong>{{ __('Tokia') }} (*):</strong></label>
		                {!! Form::text('lugar', 'Gipuzkoako Ingeniaritza Eskola', array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
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
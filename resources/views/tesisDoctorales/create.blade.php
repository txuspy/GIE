@extends('layouts.app')
@section('content')
	{!! Breadcrumbs::render('tesisDoctorales', $tipo) !!}
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
    	            @if($tipo == 'proximaLectura')
    					<h2>{{ __('Uneko Tesiak') }}</h2>
    				@else
    					<h2>{{ __('Tesiak') }}</h2>
    				@endif
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="{{ route('tesisDoctorales.index', ['tipo'  => $tipo ]) }}"><i class="fa fa-reply" title="{{ __('Atzera') }}"></i></a>
    	        </div>
    	    </div>


	{!! Form::open(array('route' => 'tesisDoctorales.store','method'=>'POST', 'class'=>'form' )) !!}
	<div>
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>Izenburua / Titulo (*):</strong></label>
                @if ($errors->has('titulo_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')) !!}
            </div>

        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>
        <!--
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                {!! Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorTesisDoctorales')) !!}
            </div>
        </div>
        -->
    </div>
	<div>
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong> {{ __('Saila') }} (*):</strong></label>
                @if ($errors->has('departamento'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
            </div>
        </div>

        <div class="col-sm-2">
           {{ Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('euskera', 1, '', ['class' => '']) }}
        </div>
        <div class="col-sm-2">
           {{ Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('internacional', 1, '', ['class' => '']) }}
        </div>
     </div>
     <div>
        <div class="col-sm-2">
            <div class="form-group has-error">
                <label><strong>{{ __('Data') }} (*):</strong></label>
                @if ($errors->has('fechaLectura'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('fechaLectura', date('Y') , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>

    <p><small>(*) {{ __('Derrigorrezko eremuak') }}</small></p>
    <div>
        <div class="col-md-12 col-sm-12 col-md-12 text-center">
            {{ Form::hidden('tipo', $tipo) }}
            {{ Form::hidden('user_id', \Auth::user()->id) }}

			<button type="submit" class="btn btn-success">
			   <i class="fa fa-plus" title ="{{ __('Berria sortu') }}"></i> {{ __('Jarraitu') }}
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
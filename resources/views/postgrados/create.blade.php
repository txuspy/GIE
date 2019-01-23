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
		            <div class="form-group  has-error">
		                <label><strong>{{ __('Programa') }} (*):</strong></label>
		                @if ($errors->has('titulo_eu'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Programa','class' => 'form-control', 'data-tipo'  => $tipo)) !!}
		            </div>

		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>{{ __('Kurtsoa') }} (*):</strong></label>
		                @if ($errors->has('curso_eu'))
	                       <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif

		                {!! Form::text('curso_eu', null, array('placeholder' => 'Kurtsoa','class' => 'form-control', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>

		    </div>
		    <!--<div>


		         <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Programa :</strong></label>
		                {!! Form::text('titulo_es', null, array('placeholder' => 'Programa','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Curso :</strong></label>
		                {!! Form::text('curso_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>

		    </div>-->
			<div>
				<div class="col-sm-6 ">
                   <div class="form-group  has-error">
                        <label><strong>{{ __('Saila') }} (*):</strong> </label>
                        {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
                    </div>
                </div>
                <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>{{ __('Iraupena') }} (*):</strong><small>(ETCS)</small></label>
		                @if ($errors->has('duracion'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif

		                {!! Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
		            </div>

		        </div>
		    </div>
		    <div>

                <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>{{ __('Tokia') }} (*):</strong></label>
		                 @if ($errors->has('lugar'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
		                {!! Form::text('lugar', '', array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control ')) !!}
		            </div>
		        </div>
		         <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>{{ __('Hasiera Data') }} (*):</strong></label>
		                @if ($errors->has('fecha'))
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    @endif
		                {!! Form::text('fecha', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')) !!}
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
@extends('layouts.app')

@section('content')
  	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2>{{ __('Word Sortu') }}</h2>
				</div>
			</div>
		</div>
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
		<!--<div class="alert alert-success">
			<p>{{ __('Urte oso bat, aukeratzen den urtetik aurrera izango da') }}</p>
		</div>-->
	{!! Form::open(array('url' => App\Lib\Functions::parseLang().'/word' , 'method' => 'post', 'class' =>'form-horizontal')) !!}
<div style="margin:45px;">


	<div class="row" >
        <div class="col-xs-4">
             <div class="form-group">
	            <label><strong>{{ __('Hizkuntza') }} (*):</strong></label>
	            @if ($errors->has('lng'))
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            @endif
	            {!! Form::select('lng', ['eu' => 'Euskara', 'es' => 'Castellano' ], Session::get('locale') , ['class' => 'form-control chosen-type'])  !!}
	        </div>
        </div>
    </div>
    	<div class="row" >
        <div class="col-xs-4">
             <div class="form-group">
	            <label><strong>{{ __('Hasiera Data') }} (*):</strong></label>
	            @if ($errors->has('desde'))
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            @endif
	            {!! Form::text('desde', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->subYears(1)->format('Y-m-d') ,'class' => 'datepicker form-control ')) !!}
	        </div>
        </div>
    </div>
     <div class="row" >
        <div class="col-xs-4">
             <div class="form-group">
	            <label><strong>{{ __('Bukatze Data') }} (*):</strong></label>
	            @if ($errors->has('hasta'))
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            @endif
	            {!! Form::text('hasta', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')) !!}
	        </div>
        </div>
    </div>



 	<div class="row">
		<div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>{{ __('Atal') }} :</strong></label>
                <i class="fa fa-info-circle mostarSelect" title="{{ __('Atal ezberdinak nahi badituzu, sakatu') }}"></i>
                {!! Form::select('secciones[]',
                [
	                '2' => __('Postgrados'),
	                '3' => __('Formaciones'),
	                '4' => __('Programas de intercambio'),
	                '5' => __('Visitas'),
	                '6' => __('Grupo de investigacion'),
	                '7' => __('Tesis'),
	                '9' => __('Equipamiento Nuevo'),
	                '10' => __('Proyectos'),
	                '11' => __('Congresos'),
	                '12' => __('Publicaciones'),
	                '13' => __('Unibertsitate aurreko ikasleei bideratutako ekintzak'),
	                '14' => __('Eskolako ikasleei bideratutako ekintzak'),
	                '15' => __('Eskolaren hedakuntza'),
	                '16' => __('Hedabideak')
	                
                ] , [2,3,4,5,6,7,9,10,11,12,13,14,15,16], ['multiple'=>'multiple', 'id' =>'secciones', 'class' => 'form-control chosen-type ocultar'])  !!}

            </div>
            <script>
				$(".mostarSelect").click(function() {
					$("#secciones").toggle();
				});
			</script>
        </div>
    </div>

    @if(\Auth::user()->hasRole('owner') OR \Auth::user()->hasRole('admin'))
    	<div class="row">
			<div class="col-xs-4 ">
	            <div class="form-group">
	                <label><strong>{{ __('Erabiltzaileak') }} :</strong></label>
	                <i class="fa fa-info-circle mostarSelect" title="{{__('Erabiltzaile ezberdinak nahi badituzu, sakatu')}}"></i>
	                {!! Form::select('usuarios[]',
	                [
		                'todos' => __('denak'),
		                'unico' =>  __('zu')." ( ".Auth::user()->name." )"

	                ] , ['todos'], ['multiple'=>'multiple', 'id' =>'usuarios', 'class' => 'form-control chosen-type ocultar'])  !!}
	            </div>
	            <script>
					$(".mostarSelect").click(function() {
						$("#usuarios").toggle();
					});
				</script>
	        </div>
	    </div>
    @endif

    <div class="row">
        <div>
			<button type="submit" class="btn btn-primary"><i class="fa fa-plus" title ="{{ __('Word sortu') }}"></i> {{ __('Word sortu') }}</button>
        </div>
        <script type="text/javascript">
			$('.date-year').datepicker({
			    minViewMode: 2,
			    format     : 'yyyy',
			});
			$('.date-mes').datepicker({
			    minViewMode: 1,
			    format     : 'mm',
			    language: "{{\Session::get('locale')}}"
			});
		</script>
	{!! Form::close() !!}
	</div>
</div>

@endsection

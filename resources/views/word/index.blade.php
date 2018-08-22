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
		<div class="alert alert-success">
			<p>{{ __('Urte oso bat, aukeratzen den urtetik aurrera izango da') }}</p>
		</div>
	{!! Form::open(array('url' => App\Lib\Functions::parseLang().'/word' , 'method' => 'post', 'class' =>'form-horizontal')) !!}
<div style="margin:45px;">
	<div class="row" >
        <div class="col-xs-2">
            <div class="form-group">
                <label><strong>{{ __('Aukeratu urtea') }} :</strong></label>
                {!! Form::text('year',  null , array('placeholder' => __('Aukeratu urtea') ,'class' => 'date-year form-control')) !!}
            </div>
        </div>
    </div>

    <div class="row">
		<div class="col-xs-2 ">
            <div class="form-group">
                <label><strong>{{ __('Aukeratu hilabetea') }} :</strong></label>
                {!! Form::text('mes',  null , array('placeholder' => __('Aukeratu hilabetea') ,'class' => 'date-mes form-control')) !!}
            </div>
        </div>
    </div>

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

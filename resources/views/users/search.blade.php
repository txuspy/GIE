<div id="seccionSearch" class="alert alert-info ">
{!! Form::open(array('route' => 'users.search', 'method'=>'POST' )) !!}
	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Izena') }}:</strong></label>
                {!! Form::text('name', null, array('placeholder' => __('Izena'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Abizenak') }} :</strong></label>
                {!! Form::text('lname', null, array('placeholder' => __('Abizenak'),'class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Posta elektronikoa') }}:</strong></label>
                {!! Form::text('email', null, array('placeholder' => __('Posta elektronikoa'),'class' => 'form-control')) !!}
            </div>
        </div>
 	</div>
 	<div class="row" style="margin:1px;">
        <div class="col-sm-12">
            <div class="form-group">

            	<br><br>
    			<button type="submit" class="btn btn-primary col-sm-12 "><i class="fa fa-search" title ="{{ __('Bilatu') }}"></i>  {{ __('Bilatu') }}</button>
            </div>
        </div>
    </div>



	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
{!! Form::close() !!}
</div>
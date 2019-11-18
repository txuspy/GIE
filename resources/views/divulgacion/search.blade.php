<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'divulgacion.search', 'method'=>'POST' )) !!}
	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Izenburua')  }}:</strong></label>
                @if ($errors->has('titulo_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif

                {!! Form::text('titulo_eu', null, array('placeholder' => __('Izenburua') ,'class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Deskripzioa')  }}:</strong></label>
                @if ($errors->has('desc_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif

                {!! Form::text('desc_eu', null, array('placeholder' => __('Deskripzioa') ,'class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)) !!}
            </div>
        </div>
    </div>

	<div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Data') }}:</strong></label>
                @if ($errors->has('fecha'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('fecha',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
		
    </div>

    
 	<div class="row" style="margin:1px;">
        <div class="col-sm-12">
            <div class="form-group">
                {{ Form::hidden('tipo', $tipo) }}
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
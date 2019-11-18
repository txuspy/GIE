<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'equipamientoNuevo.search', 'method'=>'POST' )) !!}
   <div>
	 <div>
            		<div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Hornikuntza') }} (*):</strong></label>
                            @if ($errors->has('hornikuntza'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('hornikuntza', null, array('placeholder' => __('Hornikuntza')  ,'class' => 'form-control buscadorEquipamientoNuevo')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Ekipamendua') }} :</strong></label>
                            {!! Form::text('ekipamendua', null, array('placeholder' => __('Ekipamendua'),'class' => 'form-control buscadorEquipamientoNuevo')) !!}
                        </div>
                    </div>
                </div>
            	<div>
            		<div class="col-sm-6 ">
                       <div class="form-group has-error">
                            <label><strong>{{ __('Saila') }} (*):</strong></label>
                            {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Instituzioa') }} (*):</strong></label>
                            @if ($errors->has('institucion'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            	<div>

                    <div class="col-sm-6 ">
                        <div class="form-group has-error">
                            <label><strong>{{ __('Data') }} (*):</strong></label>
                            @if ($errors->has('data'))
    	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
    	                    @endif
                            {!! Form::text('data',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y') ,'class' => 'datepicker form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>{{ __('Zenbateko') }} :</strong><small>(€)</small></label>
                            {!! Form::text('importe', null, array('placeholder' => 15000,'class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>

	    <div class="row" style="margin:1px;">
	        <div class="col-sm-12">
	            <div class="form-group">
					<br>
	    			<button type="submit" class="btn btn-primary col-sm-12 "><i class="fa fa-search" title ="{{ __('Bilatu') }}"></i>  {{ __('Bilatu') }}</button>
	            </div>
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
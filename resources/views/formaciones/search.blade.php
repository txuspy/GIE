<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'formaciones.search', 'method'=>'POST' )) !!}
    <div>
    	<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Ikastaroa') }} (*):</strong></label>
                 {!! Form::text('titulo_eu', null, array('placeholder' =>  __('Ikastaroa') ,'class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)) !!}

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Hasiera-Data') }} (*) :</strong></label>
                {!! Form::text('fecha', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker  form-control')) !!}
            </div>
        </div>
    </div>
    @if( $modo == 'recibir' )
	     <div>
			<div class="col-sm-6 ">
	            <div class="form-group">
	                <label><strong>Antolatzailea(k) (*):</strong></label>
	                {!! Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control buscadorformaciones')) !!}
	            </div>
	        </div>
	        <div class="col-sm-6 ">
	            <div class="form-group">
	                <label><strong>Organizador(es):</strong></label>
	                {!! Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control buscadorformaciones')) !!}
	            </div>
	        </div>
	    </div>
	@endif
	<div class="row" style="margin:1px;">

		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Tokia') }} :</strong></label>
                {!! Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK' ,'class' => 'form-control ')) !!}
            </div>
        </div>
    </div>
    <div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Iraupena') }} :</strong><small>(h)</small></label>
                {!! Form::text('duracion', null, array('placeholder' => '10 h' ,'class' => 'form-control ')) !!}
            </div>
        </div>
    </div>

    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    		<label><strong>
    				@if( $modo == 'recibir' )
						{{ __('Parte-hartzailea(k)') }} (*)
					@else
						{{ __('Hizlaria(k)') }} (*)
					@endif
				</strong></label>
    	 	{{Form::text('formacionesAutores', '', [
		        'id'           =>'formacionesAutores',
		        'placeholder'  =>__('Egilea bilatu'),
		        'class'        =>'form-control buscadorDeAutor inputAutores',
		        'data-idDialog'=>'dialogFormacionesAutores',
		        'data-carpeta' =>'autores',
		        'data-tipo'    =>'formaciones',
		        'data-modo'    =>'formaciones',
		        'data-idUl'    =>'ulFormacionesAutores',

    	 	]
    	 	)}}
    	 	{{ Form::hidden('id_autor', '', ['id' => 'id_autor' ]) }}
	 	</div>
	</div>

    <div class="row" style="margin:1px;">
        <div class="col-sm-12">
            <div class="form-group">
            	{{ Form::hidden('tipo', $tipo) }}
    	        {{ Form::hidden('modo', $modo) }}
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
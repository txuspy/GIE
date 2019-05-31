<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'programasDeIntercambio.search', 'method'=>'POST' )) !!}
   <div>
		<div class="col-sm-6 ">
              <div class="form-group has-error">
                <label><strong>Aktibitatea:</strong></label>
                @if ($errors->has('actividad_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )) !!}
            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Actividad :</strong></label>
                {!! Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )) !!}
            </div>
        </div>
        <div>
            <div class="col-sm-6 ">
                  <div class="form-group has-error">
                    <label><strong>{{ __('Noiztik') }}:</strong></label>
                    @if ($errors->has('desde'))
                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                    @endif
                    {!! Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                </div>
            </div>
    		<div class="col-sm-6 ">
                <div class="form-group">
                    <label><strong>{{ __('Noiz arte') }} :</strong></label>
                    {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addMonths(6)->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
                </div>
            </div>
        </div>

		<div class="col-sm-6 ">
              <div class="form-group has-error">
                <label><strong>{{ __('Tokia') }}:</strong></label>
                @if ($errors->has('lugar'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif
                {!! Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control')) !!}
            </div>
        </div>


		<div class="row" style="margin:1px;">
			<div class="col-sm-6">
				<label>
					<strong>
						@if( $tipo  == 'azp' )
							{{ __('IIP / AZP') }}
						@else
							{{ __('Irakaslea(k)')}}:
						@endif
					</strong>
				</label>
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
	            	<br><br>
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
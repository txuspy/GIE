<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'proyectos.search', 'method'=>'POST' )) !!}
	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Proiektua')  }}:</strong></label>
                @if ($errors->has('proyecto_eu'))
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                @endif

                {!! Form::text('proyecto_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)) !!}
            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>{{ __('Finantziazioa')  }}:</strong></label>
                {!! Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')) !!}
            </div>
        </div>
    </div>

	<div class="row" style="margin:1px;">
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
                {!! Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addYear('1')->format('Y-m-d') ,'class' => 'datepicker form-control')) !!}
            </div>
        </div>
    </div>

    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong>{{ __('Ikertzaile nagusia(k)')}}:</strong></label>
        	 	{{Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)}}
                {{ Form::hidden('id_autor', '', ['id' => 'id_autor' ]) }}
	 	    </div>
	 	</div>
	 		<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong>{{ __('Partaidea(k)')}}  :</strong></label>
        	 	{{Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor2',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)}}
                {{ Form::hidden('id_autor2', '', ['id' => 'id_autor2' ]) }}
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
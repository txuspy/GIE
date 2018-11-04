<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'grupoInvestigacion.search', 'method'=>'POST' )) !!}
	<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Taldea (*)</strong></label>
                {!! Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control buscadorGrupoInvestigacion')) !!}
            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Grupo:</strong></label>
                {!! Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control buscadorGrupoInvestigacion')) !!}
            </div>
        </div>

    </div>
	<div>
		 <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Ikerkuntza lerroak (*):</strong></label>
                {!! Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control summernote')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Líneas de investigación :</strong></label>
                {!! Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control summernote')) !!}
            </div>
        </div>
    </div>
	<div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Noiztik') }} (*)</strong></label>
                {!! Form::text('desde',  null , array('placeholder' => __('Noiztik') ,'class' => 'date-year form-control')) !!}
            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Arte') }} :</strong></label>
                {!! Form::text('hasta', null , array('placeholder' => __('Hutsik utzi gaur egun martxan badago') ,'class' => 'date-year form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong>{{ __('Arduraduna(k)')}} :</strong></label>
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
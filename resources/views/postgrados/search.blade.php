<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'postgrados.search', 'method'=>'POST' )) !!}
	<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Programa') }}:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorPostgrados', 'data-tipo' => $tipo  )) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Ikastaroa') }}:</strong></label>
                {!! Form::text('curso_eu', null, array('placeholder' => 'Ikastaroa','class' => 'form-control')) !!}
            </div>
        </div>
    </div>
	<div>
        <div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>{{ __('Saila') }} (*):</strong></label>
                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '' , ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Iraupena') }}(*):</strong></label>
                {!! Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')) !!}
            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
       <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Tokia') }} (*):</strong></label>
                {!! Form::text('lugar', false, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control ')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Hasiera Data') }} (*):</strong></label>
                {!! Form::text('fecha', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')) !!}
            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong>{{ __('Irakaslea(k)')}} (*):</strong></label>
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
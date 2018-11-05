<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'tesisDoctorales.search', 'method'=>'POST' )) !!}
		<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Izenburua / Titulo:</strong></label>
                {!! Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control buscadorTesisDoctorales')) !!}
            </div>
        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>

    </div>
	<div>
		<div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>Saila/ Departamento (*):</strong></label>
                {!! Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '', ['id' =>'departamento',   'class' => 'form-control chosen-select'])  !!}
            </div>
        </div>
		<div class="col-sm-3">
            {{ Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('euskera', 1, '', ['class' => '']) }}
        </div>
        <div class="col-sm-3">
           {{ Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] ) }}<br>
            {{ Form::checkbox('internacional', 1, '', ['class' => '']) }}
        </div>
	</div>


	<div class='row'>
		<div style="margin:30px;">
			@if($tipo=='tesisLeidas')
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>{{ __('Data') }} :</strong></label>
			                {!! Form::text('fechaLectura', '' , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')) !!}
			            </div>
			        </div>
			    </div>
			    <div class="col-sm-6 "> </div>
		    @endif
		    @if($tipo=='proximaLectura')
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>{{ __('Kurtsoa') }} :</strong></label>
			                <span><i>( {{ $tesisDoctoral->curso }} - {{ $tesisDoctoral->curso +1 }} )</i></span>
			                {!! Form::text('curso', '' , array('placeholder' => __('Kurtsoa') ,'class' => 'date-year form-control')) !!}
			            </div>
			        </div>
			    </div><div class="col-sm-6 "> </div>
		    @endif
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
    		        'id'           =>'postgradosAutores2',
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
<div id="seccionSearch" class="alert alert-info ocultar">
{!! Form::open(array('route' => 'publicaciones.search', 'method'=>'POST' )) !!}
	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>{{ __('Izenburua') }} (*):</strong></label>
		                {!! Form::text('titulo_eu', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorPublicaciones', 'data-tipo'  => $tipo)) !!}
		            </div>
		        </div>
		        <div class="col-sm-6 ">

		           @if( $tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('Argitaletxea') }} :</strong></label>
			                {!! Form::text('editorialRevisa',  null , array('placeholder' => __('Argitaletxea') ,'class' => 'form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('Aldizkaria') }} :</strong></label>
		                	{!! Form::text('editorialRevisa',  null , array('placeholder' => __('Aldizkaria') ,'class' => 'form-control buscadorAldikariak')) !!}
		            	</div>
		            @endif


		        </div>

		    </div>

		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		        	@if( $tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('Kapitulo') }} :</strong></label>
			                {!! Form::text('capitulo',  null , array('placeholder' => __('Kapitulo') ,'class' => ' form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('Bolumena') }} :</strong></label>
		                	{!! Form::text('volumen',  null , array('placeholder' => __('Bolumena') ,'class' => ' form-control')) !!}
		            	</div>
		            @endif
		        </div>
		         <div class="col-sm-6 ">
		        	@if( $tipo =='libros')
			            <div class="form-group">
			                <label><strong>{{ __('ISBN') }} :</strong></label>
			                {!! Form::text('ISBN',  null , array('placeholder' => __('ISBN') ,'class' => ' form-control')) !!}
			            </div>
		            @else
		              	<div class="form-group">
		                	<label><strong>{{ __('ISSN') }} :</strong></label>
		                	{!! Form::text('ISBN',  null , array('placeholder' => __('ISSN') ,'class' => ' form-control')) !!}
		            	</div>
		            @endif
		        </div>


		    </div>
    <div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>{{ __('Data') }} (*):</strong></label>
                {!! Form::text('year', null , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')) !!}
            </div>
        </div>
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong>{{ __('Egilea(k)')}}:</strong></label>
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
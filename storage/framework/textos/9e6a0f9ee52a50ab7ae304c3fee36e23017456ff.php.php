<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'postgrados.search', 'method'=>'POST' )); ?>

	<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Programa')); ?>:</strong></label>
                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorPostgrados', 'data-tipo' => $tipo  )); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Ikastaroa')); ?>:</strong></label>
                <?php echo Form::text('curso_eu', null, array('placeholder' => 'Ikastaroa','class' => 'form-control')); ?>

            </div>
        </div>
    </div>
	<div>
        <div class="col-sm-6 ">
           <div class="form-group">
                <label><strong><?php echo e(__('Saila')); ?> (*):</strong></label>
                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '' , ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Iraupena')); ?>(*):</strong></label>
                <?php echo Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')); ?>

            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
       <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
                <?php echo Form::text('lugar', false, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control ')); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Hasiera Data')); ?> (*):</strong></label>
                <?php echo Form::text('fecha', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

            </div>
        </div>
    </div>
    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Irakaslea(k)')); ?> (*):</strong></label>
        	 	<?php echo e(Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)); ?>

                <?php echo e(Form::hidden('id_autor', '', ['id' => 'id_autor' ])); ?>

	 	    </div>
	 	</div>
 	</div>
 	<div class="row" style="margin:1px;">
        <div class="col-sm-12">
            <div class="form-group">
            	<?php echo e(Form::hidden('tipo', $tipo)); ?>

            	<br><br>
    			<button type="submit" class="btn btn-primary col-sm-12 "><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>"></i>  <?php echo e(__('Bilatu')); ?></button>
            </div>
        </div>
    </div>



	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php echo Form::close(); ?>

</div>
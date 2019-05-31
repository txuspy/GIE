<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'formaciones.search', 'method'=>'POST' )); ?>

    <div>
    	<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Ikastaroa')); ?> (*):</strong></label>
                 <?php echo Form::text('titulo_eu', null, array('placeholder' =>  __('Ikastaroa') ,'class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>


            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Hasiera-Data')); ?> (*) :</strong></label>
                <?php echo Form::text('fecha', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker  form-control')); ?>

            </div>
        </div>
    </div>
    <?php if( $modo == 'recibir' ): ?>
	     <div>
			<div class="col-sm-6 ">
	            <div class="form-group">
	                <label><strong>Antolatzailea(k) (*):</strong></label>
	                <?php echo Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control buscadorformaciones')); ?>

	            </div>
	        </div>
	        <div class="col-sm-6 ">
	            <div class="form-group">
	                <label><strong>Organizador(es):</strong></label>
	                <?php echo Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control buscadorformaciones')); ?>

	            </div>
	        </div>
	    </div>
	<?php endif; ?>
	<div class="row" style="margin:1px;">

		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Tokia')); ?> :</strong></label>
                <?php echo Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK' ,'class' => 'form-control ')); ?>

            </div>
        </div>
    </div>
    <div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Iraupena')); ?> :</strong><small>(h)</small></label>
                <?php echo Form::text('duracion', null, array('placeholder' => '10 h' ,'class' => 'form-control ')); ?>

            </div>
        </div>
    </div>

    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    		<label><strong>
    				<?php if( $modo == 'recibir' ): ?>
						<?php echo e(__('Parte-hartzailea(k)')); ?> (*)
					<?php else: ?>
						<?php echo e(__('Hizlaria(k)')); ?> (*)
					<?php endif; ?>
				</strong></label>
    	 	<?php echo e(Form::text('formacionesAutores', '', [
		        'id'           =>'formacionesAutores',
		        'placeholder'  =>__('Egilea bilatu'),
		        'class'        =>'form-control buscadorDeAutor inputAutores',
		        'data-idDialog'=>'dialogFormacionesAutores',
		        'data-carpeta' =>'autores',
		        'data-tipo'    =>'formaciones',
		        'data-modo'    =>'formaciones',
		        'data-idUl'    =>'ulFormacionesAutores',

    	 	]
    	 	)); ?>

    	 	<?php echo e(Form::hidden('id_autor', '', ['id' => 'id_autor' ])); ?>

	 	</div>
	</div>

    <div class="row" style="margin:1px;">
        <div class="col-sm-12">
            <div class="form-group">
            	<?php echo e(Form::hidden('tipo', $tipo)); ?>

    	        <?php echo e(Form::hidden('modo', $modo)); ?>

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
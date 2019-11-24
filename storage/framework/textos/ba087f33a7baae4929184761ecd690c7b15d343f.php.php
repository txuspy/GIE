<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'proyectos.search', 'method'=>'POST' )); ?>

	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Proiektua')); ?>:</strong></label>
                <?php if($errors->has('proyecto_eu')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>

                <?php echo Form::text('proyecto_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)); ?>

            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Finantziazioa')); ?>:</strong></label>
                <?php echo Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')); ?>

            </div>
        </div>
    </div>

	<div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Noiztik')); ?>:</strong></label>
                <?php if($errors->has('desde')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
                <?php echo Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addYear('1')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

            </div>
        </div>
    </div>

    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Ikertzaile nagusia(k)')); ?>:</strong></label>
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
	 		<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Partaidea(k)')); ?>  :</strong></label>
        	 	<?php echo e(Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor2',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)); ?>

                <?php echo e(Form::hidden('id_autor2', '', ['id' => 'id_autor2' ])); ?>

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
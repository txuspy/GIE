<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'ekintzak.search', 'method'=>'POST' )); ?>

	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Izenburua')); ?>:</strong></label>
                <?php if($errors->has('titulo_eu')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>

                <?php echo Form::text('titulo_eu', null, array('placeholder' => __('Izenburua') ,'class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Deskripzioa')); ?>:</strong></label>
                <?php if($errors->has('desc_eu')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>

                <?php echo Form::text('desc_eu', null, array('placeholder' => __('Deskripzioa') ,'class' => 'form-control buscadorProyectos', 'data-tipo'  => $tipo)); ?>

            </div>
        </div>
    </div>

	<div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Data')); ?>:</strong></label>
                <?php if($errors->has('fecha')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('fecha',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

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
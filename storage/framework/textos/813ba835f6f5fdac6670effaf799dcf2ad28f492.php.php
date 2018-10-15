<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('visitas' ); ?>

	<div class="panel panel-default">
        <?php if(count($errors) > 0): ?>
    		<div class="alert alert-danger">
    			<strong>Whoops!</strong> <?php echo e(__('Akats batzuk daude ')); ?><br><br>
    			<ul>
    				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    					<li><?php echo e($error); ?></li>
    				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    			</ul>
    		</div>
    	<?php endif; ?>
        <div class="panel-body">
            <div class="col-sm-12 margin-tb">
		        <div class="pull-left">

					<h2><?php echo e(__('Bisitak')); ?></h2>

		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('visitas.index' )); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
	        </div>

			<?php echo Form::open(array('route' => 'visitas.store','method'=>'POST', 'class'=>'form' )); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong>Aktibitatea (*):</strong></label>
		                 <?php if($errors->has('titulo_eu')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Aktibitatea','class' => 'form-control buscadorVisitas')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad :</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Actividad','class' => 'form-control buscadorVisitas')); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
		                <?php if($errors->has('lugar')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('lugar', null , array('placeholder' => __('Tokia') ,'class' => 'form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
		                <?php if($errors->has('fecha')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
		    </div>
		     <div>
                <div class="col-sm-12">
                    <p ><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
                </div>
            </div>

		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">

		            <?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

					<button type="submit" class="btn btn-success">
					   <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

				    </button>
		        </div>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
    <script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
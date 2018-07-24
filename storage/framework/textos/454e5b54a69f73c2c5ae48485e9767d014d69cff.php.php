<?php $__env->startSection('content'); ?>
<div class="container">
   <?php echo Breadcrumbs::render('autoresEdit', $autor); ?>

    <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload OK.')); ?></strong>
	</div>
	<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload ERROR.')); ?></strong>
	</div>
	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<strong><?php echo e(__('Whoops!')); ?></strong> <?php echo e(__('There were some problems with your input.')); ?><br><br>
			<ul>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<li><?php echo e($error); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php echo Form::model($autor, ['method' => 'PATCH','route' => ['autor.update', $autor->id]]); ?>

	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Izena')); ?>:</strong>
                <?php echo Form::text('nombre', null, array('placeholder' => __('Izena'),'class' => 'form-control')); ?>

            </div>
        </div>
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Abizenak')); ?>:</strong>
                <?php echo Form::text('apellido', null, array('placeholder' => __('Abizenak') ,'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
				<button type="submit" class="btn btn-primary"><?php echo e(__('Bidali')); ?></button>
        </div>
	</div>
	<?php echo Form::close(); ?>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2><?php echo e(__('Erabiltzaile berria')); ?></h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> <?php echo e(__('Atzera')); ?></a>
	        </div>
	    </div>
	</div>
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
	<?php echo Form::open(array('route' => 'users.store','method'=>'POST', 'class'=>'form' )); ?>

	<div class="row">
		<div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Izena')); ?>:</strong></label>
                <?php echo Form::text('name', null, array('placeholder' => __('Izena'),'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Abizenak')); ?> :</strong></label>
                <?php echo Form::text('lname', null, array('placeholder' => __('Abizenak'),'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Estado')); ?> :</strong></label>
                <?php echo Form::select('estado', ['1' => __('Activo'), '0' => __('Baja') ],1 , ['class' => 'form-control chosen-type']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Posta elektronikoa')); ?>:</strong></label>
                <?php echo Form::text('email', null, array('placeholder' => __('Posta elektronikoa'),'class' => 'form-control')); ?>

            </div>
        </div>
       <div class="col-xs-4">
            <div class="form-group">
                <label><strong><?php echo e(__('Hizkuntza')); ?> :</strong></label>
                <?php echo Form::select('lng', ['eu' => 'Euskara', 'es' => 'Castellano' ],1 , ['class' => 'form-control chosen-type']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Pasahitza')); ?> :</strong></label>
                <?php echo Form::password('password', array('placeholder' => __('Pasahitza'),'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Pasahitza Konfirmatu')); ?>:</strong></label>
                <?php echo Form::password('confirm-password', array('placeholder' => __('Pasahitza Konfirmatu'),'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group  input-text-wrapper">
                <label><strong><?php echo e(__('Errola')); ?>:</strong></label>
                <?php echo Form::select('roles[]', $roles, 4, array('class' => 'form-control','multiple')); ?>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary"><?php echo e(__('Bidali')); ?></button>
        </div>
	</div>
	<?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
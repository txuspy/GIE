<?php $__env->startSection('content'); ?>
<div class="container">
    <?php echo Breadcrumbs::render('usuariosVer', $user); ?>

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2> Show User</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> Back</a>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="panel panel-default">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <?php echo e($user->name); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <?php echo e($user->email); ?>

            </div>
        </div>
        <div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
                <strong>Roles:</strong>
                <?php if(!empty($user->roles)): ?>
					<?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<label class="label label-success"><?php echo e($v->display_name); ?></label>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<?php endif; ?>
				</div>
            </div>
        </div>
	</div>
	</div>
	  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
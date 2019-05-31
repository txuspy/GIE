<?php $__env->startSection('content'); ?>
    @permission('role-list')
    	<div class="container">
            <?php echo Breadcrumbs::render('rolesVer', $role); ?>

        	<div class="row">
        	    <div class="col-lg-12 margin-tb">
        	        <div class="pull-left">
        	            <h2> Show Role</h2>
        	        </div>
        	        <div class="pull-right">
        	            <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>"> Back</a>
        	        </div>
        	    </div>
        	</div>
        	<div class="row">

        		<div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <?php echo e($role->display_name); ?>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <?php echo e($role->description); ?>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions:</strong>
                        <?php if(!empty($rolePermissions)): ?>
        					<?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        						<label class="label label-success"><?php echo e($v->display_name); ?></label>
        					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        				<?php endif; ?>
                    </div>
                </div>
        	</div>
    	</div>
	@endpermission
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
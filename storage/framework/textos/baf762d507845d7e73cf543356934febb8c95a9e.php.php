<?php $__env->startSection('content'); ?>
@permission('role-list')
	<div class="container">
		<?php echo Breadcrumbs::render('rolesEdit', $role); ?>

		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="pull-left">
		            <h2>Edit Role</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>"> Back</a>
		        </div>
		    </div>
		</div>
		<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php echo Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]); ?>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Name:</strong>
	                <?php echo Form::text('display_name', null, array('placeholder' => 'Name','class' => 'form-control')); ?>

	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Description:</strong>
	                <?php echo Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')); ?>

	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12">
	            <div class="form-group">
	                <strong>Permission:</strong>
	                <br/>
	                <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	                	<label><?php echo e(Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name'))); ?>

	                	<?php echo e($value->display_name); ?></label><br> <?php echo e($value->description); ?> ("<?php echo e($value->name); ?>")
	                	<br/>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	            </div>
	        </div>
	        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
	        </div>
		</div>
		<?php echo Form::close(); ?>

	</div>
@endpermission
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
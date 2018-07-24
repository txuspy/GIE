<?php $__env->startSection('content'); ?>
@permission('role-list')
	<div class="container">
<?php echo Breadcrumbs::render('roles'); ?>

		<div class="row">
		    <div class="col-lg-12 margin-tb">
		        <div class="pull-left">
		            <h2>Role Management</h2>
		        </div>
		        <div class="pull-right">
		        	@permission('role-create')
		            <a class="btn btn-success" href="<?php echo e(route('roles.create')); ?>"> Create New Role</a>
		            @endpermission
		        </div>
		    </div>
		</div>
		<?php if($message = Session::get('success')): ?>
			<div class="alert alert-success">
				<p><?php echo e($message); ?></p>
			</div>
		<?php endif; ?>
		<table class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Description</th>
				<th width="280px">Action</th>
			</tr>
		<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<tr>
			<td><?php echo e(++$i); ?></td>
			<td><?php echo e($role->display_name); ?></td>
			<td><?php echo e($role->description); ?></td>
			<td>
				<a class="btn btn-info" href="<?php echo e(route('roles.show',$role->id)); ?>">Show</a>
				@permission('role-edit')
				<a class="btn btn-primary" href="<?php echo e(route('roles.edit',$role->id)); ?>">Edit</a>
				@endpermission
				@permission('role-delete')
				<?php echo Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']); ?>

	            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

	        	<?php echo Form::close(); ?>

	        	@endpermission
			</td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</table>
		<?php echo $roles->render(); ?>

	</div>
@endpermission
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
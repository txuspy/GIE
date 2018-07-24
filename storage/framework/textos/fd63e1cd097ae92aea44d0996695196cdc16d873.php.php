<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('usuarios'); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2><?php echo e(__('Erabiltzaileak')); ?></h2>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="<?php echo e(route('users.create')); ?>"> <?php echo e(__('Erabiltzaile berria sortu')); ?></a>
						</div>
					</div>
				</div>
				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>
				<table class="table">
					<tr>
						<th><?php echo e(__('N.')); ?></th>
						<th><?php echo e(__('Nombre.')); ?></th>
						<th><?php echo e(__('Email')); ?></th>
						<th><?php echo e(__('Roles')); ?></th>
						<th><?php echo e(__('Acciones')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td><?php echo e(++$i); ?>.) [ <?php echo \App\Lib\FunctionsVistas::publicar($user->estado); ?> ]</td>
						<td><?php echo e($user->name); ?> <?php echo e($user->lname); ?></td>
						<td><?php echo e($user->email); ?></td>

						<td>
							<?php if(!empty($user->roles)): ?>
							<?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<label class="label label-success"><?php echo e($v->display_name); ?></label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php endif; ?>
						</td>
						<td>

							<a class="btn btn-primary" href="<?php echo e(route('users.edit',$user->id)); ?>">Edit</a>
							<?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']); ?>

							<?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

							<?php echo Form::close(); ?>

						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Total:' )); ?> <?php echo e($data->total()); ?></td><td colspan='3' class='text-center'><?php echo e($data->links()); ?></td><td><?php echo e(__('Pagina actual:' )); ?> <?php echo e($data->currentPage()); ?></td></tr>

				</table>


			</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
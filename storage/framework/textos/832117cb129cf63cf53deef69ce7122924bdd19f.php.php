<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('autores'); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<h2><?php echo e(__('Partaideak')); ?></h2>
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
						<th><?php echo e(__('Nombre.')); ?></th>
						<th><?php echo e(__('Email')); ?></th>
						<th><?php echo e(__('Acciones')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td><?php echo e($autor->nombre); ?> </td>
						<td><?php echo e($autor->apellido); ?></td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('autor.edit',$autor->id)); ?>">Edit</a>
							<?php echo Form::open(['method' => 'DELETE','route' => ['autor.destroy', $autor->id],'style'=>'display:inline']); ?>

							<?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

							<?php echo Form::close(); ?>

						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Total:' )); ?> <?php echo e($data->total()); ?></td><td class='text-center'><?php echo e($data->links()); ?></td><td><?php echo e(__('Pagina actual:' )); ?> <?php echo e($data->currentPage()); ?></td></tr>
				</table>
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
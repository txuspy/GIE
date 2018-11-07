<?php $__env->startSection('content'); ?>

	<?php echo Breadcrumbs::render('equipamientoNuevo'); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2><?php echo e(__('Hornikuntza Zientifikoa eskuratzea')); ?></h2>
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="<?php echo e(route('equipamientoNuevo.indexAll')); ?>"><i class="fa fa-list" title="<?php echo e(__('Kongresu zientifiko guztiak ikusi')); ?>"></i></a>

								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('equipamientoNuevo.create')); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i></a>
						</div>
					</div>
				</div>
				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>
					<?php echo $__env->make('equipamientoNuevo.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<table class="table">
					<tr>
						<th><?php echo e(__('Hornikuntza')); ?></th>
						<th><?php echo e(__('Saila')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php if($data): ?>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $equipamientoNuevo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<tr>
							<td>
								<?php
								$equipo = "hornikuntza" ;
								$departamento = "departamento" ;
								?>
								<a href="<?php echo e(route('equipamientoNuevo.edit',$equipamientoNuevo->id)); ?>"><?php echo e($equipamientoNuevo->$equipo); ?>, ( <?php echo e($equipamientoNuevo->data); ?> )</a>
								<br> <i>(<?php echo e($equipamientoNuevo->usuario?$equipamientoNuevo->usuario->name:''); ?> <?php echo e($equipamientoNuevo->usuario?$equipamientoNuevo->usuario->lname:''); ?>)</i>
							</td>
							<td>
								<?php echo e(\App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$equipamientoNuevo->departamento]??'---'); ?></td>
							<td>
								<a class="btn btn-primary" href="<?php echo e(route('equipamientoNuevo.edit',$equipamientoNuevo->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
								<?php if( $equipamientoNuevo->user_id == \Auth::user()->id ): ?>
									<?php echo Form::open(['method' => 'DELETE','route' => ['equipamientoNuevo.destroy', $equipamientoNuevo->id],'style'=>'display:inline']); ?>

									<?php echo e(Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )); ?>

									<?php echo Form::close(); ?>

								<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						<tr>
							<td><?php echo e(__('Guztira:' )); ?> <?php echo e($data->total()); ?></td>
							<td colspan='1' class='text-center'><?php echo e($data->links()); ?></td>
							<td><?php echo e(__('Oraingo orria:' )); ?> <?php echo e($data->currentPage()); ?></td>
							</tr>
					<?php endif; ?>
				</table>
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
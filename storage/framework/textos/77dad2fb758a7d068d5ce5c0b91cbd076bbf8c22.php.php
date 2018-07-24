<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('congresos'); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2><?php echo e(__('Kongresu Zientifikoetan parte-hartzea')); ?></h2>
						</div>
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="<?php echo e(route('congresos.indexAll')); ?>"><i class="fa fa-eye" title="<?php echo e(__('Kongresu zientifiko guztiak ikusi')); ?>"></i></a>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="<?php echo e(route('congresos.create')); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i></a>
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
						<th><?php echo e(__('Kongresu')); ?></th>
						<th><?php echo e(__('Ekarpen mota')); ?>  </th>ç
						<th><?php echo e(__('Arduraduna(k)')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $congreso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $congre = "congreso_".\Session::get('locale') ;?>
								<a href="<?php echo e(route('congresos.edit',$congreso->id)); ?>">
									<?php echo e($congreso->$congre); ?>, ( <?php echo e($congreso->desde); ?> - <?php echo e($congreso->hasta); ?> )
									</a>
							<br> <i>(<?php echo e($congreso->usuario?$congreso->usuario->name:''); ?> <?php echo e($congreso->usuario?$congreso->usuario->lname:''); ?>)</i>
						</td>
						<td>
								<?php echo e(\App\Traits\Listados::listadoEkarpena(\Session::get('locale'))[$congreso->ekarpena]??'---'); ?>

							</td>
						<td>
								<?php $__currentLoopData = $congreso->profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 					<?php echo e($profesor->nombre); ?> <?php echo e($profesor->apellido); ?>

			 					<?php if(!$loop->last): ?>
			 						,
			 					<?php endif; ?>
			 				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('congresos.edit',$congreso->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $congreso->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['congresos.destroy', $congreso->id],'style'=>'display:inline']); ?>

								<?php echo e(Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )); ?>

								<?php echo Form::close(); ?>

							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Guztira:' )); ?> <?php echo e($data->total()); ?></td><td  class='text-center'><?php echo e($data->links()); ?></td><td></td><td><?php echo e(__('Oraingo orria:' )); ?> <?php echo e($data->currentPage()); ?></td></tr>
				</table>
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
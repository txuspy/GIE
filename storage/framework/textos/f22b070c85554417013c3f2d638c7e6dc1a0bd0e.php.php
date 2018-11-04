<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('grupoInvestigacion'); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<h2><?php echo e(__('Ikerkuntza taldea')); ?></h2>
						</div>


						<div class="pull-right">
								<a class="btn btn-info" href="<?php echo e(route('grupoInvestigacion.indexAll')); ?>"><i class="fa fa-list" title="<?php echo e(__('Ikerkuntza taldea guztiak ikusi')); ?>"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('grupoInvestigacion.create')); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i> </a>
						</div>

					</div>
				</div>
				<?php if($message = Session::get('success')): ?>
					<div class="alert alert-success">
						<p><?php echo e($message); ?></p>
					</div>
				<?php endif; ?>

					<?php echo $__env->make('grupoInvestigacion.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<table class="table">
					<tr>
						<th><?php echo e(__('Taldea')); ?></th>
						<th><?php echo e(__('Arduraduna(k)')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $grupoInv): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $grupo = "grupo_".\Session::get('locale') ;?>
							<a class='' href="<?php echo e(route('grupoInvestigacion.edit',$grupoInv->id)); ?>">
								<?php echo e($grupoInv->$grupo); ?>, ( <?php echo e($grupoInv->desde); ?> - <?php echo e($grupoInv->hasta); ?> )
							</a>
							<br> <i>(<?php echo e($grupoInv->usuario?$grupoInv->usuario->name:''); ?> <?php echo e($grupoInv->usuario?$grupoInv->usuario->lname:''); ?>)</i>
						</td>
						<td>
							<?php $__currentLoopData = $grupoInv->responsables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $responsable): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 					<?php echo e($responsable->nombre); ?> <?php echo e($responsable->apellido); ?>

			 					<?php if(!$loop->last): ?>
			 						,
			 					<?php endif; ?>
			 				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('grupoInvestigacion.edit',$grupoInv->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldatu')); ?>"></i></a>
							<?php if( $grupoInv->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['grupoInvestigacion.destroy', $grupoInv->id],'style'=>'display:inline']); ?>

								<?php echo e(Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )); ?>

								<?php echo Form::close(); ?>

							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Guztira:' )); ?> <?php echo e($data->total()); ?></td><td class='text-center'><?php echo e($data->links()); ?></td><td><?php echo e(__('Oraingo orria:' )); ?> <?php echo e($data->currentPage()); ?></td></tr>
				</table>
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
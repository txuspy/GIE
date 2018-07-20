<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('proyectos', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<?php if( $tipo == 'europa' ): ?>
								<h2><?php echo e(__('Europar Batasuneko Programa Markoa')); ?></h2>
    						<?php elseif($tipo == 'erakundeak'): ?>
    							<h2><?php echo e(__('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak')); ?></h2>
   							<?php else: ?>
    							<h2><?php echo e(__('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak')); ?></h2>
							<?php endif; ?>
						</div>
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="<?php echo e(route('proyectos.indexAll', [ 'tipo'=> $tipo ])); ?>"><i class="fa fa-eye" title="<?php echo e(__('Proiektu guztiak ikusi')); ?>"></i></a>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="<?php echo e(route('proyectos.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i> </a>
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
						<th><?php echo e(__('Proiektua')); ?></th>
						<th><?php echo e(__('Ikertzaile nagusia(k)')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $proiekto = "proyecto_".\Session::get('locale') ;?>
							<a href="<?php echo e(route('proyectos.edit',$proyecto->id)); ?>"><?php echo e($proyecto->$proiekto); ?></a>
							<br> ( <?php echo e($proyecto->desde); ?> - <?php echo e($proyecto->hasta); ?> )
							<br> <i>(<?php echo e($proyecto->usuario?$proyecto->usuario->name:''); ?> <?php echo e($proyecto->usuario?$proyecto->usuario->lname:''); ?>)</i>

						</td>
						<td>
							<?php $__currentLoopData = $proyecto->directores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 					<?php echo e($director->nombre); ?> <?php echo e($director->apellido); ?>

			 					<?php if(!$loop->last): ?>
			 						,
			 					<?php endif; ?>
			 				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('proyectos.edit',$proyecto->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $proyecto->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['proyectos.destroy', $proyecto->id, $proyecto->tipo],'style'=>'display:inline']); ?>

								<?php echo e(Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )); ?>

								<?php echo Form::close(); ?>

							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Guztira:' )); ?> <?php echo e($data->total()); ?></td><td  class='text-center'><?php echo e($data->links()); ?></td><td><?php echo e(__('Oraingo orria::' )); ?> <?php echo e($data->currentPage()); ?></td></tr>
				</table>
			</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
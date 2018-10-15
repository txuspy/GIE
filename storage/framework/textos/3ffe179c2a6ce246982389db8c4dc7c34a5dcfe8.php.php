<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('tesisDoctorales', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<?php if($tipo == 'proximaLectura'): ?>
								<h2><?php echo e(__('Uneko Tesiak')); ?></h2>
							<?php else: ?>
								<h2><?php echo e(__('Tesiak')); ?></h2>
							<?php endif; ?>
						</div>
						<div class="pull-left margen-left">
							<a class="btn btn-info" href="<?php echo e(route('tesisDoctorales.indexAll', [ 'tipo'=> $tipo ])); ?>"><i class="fa fa-eye" title="<?php echo e(__('Guztiak ikusi')); ?>"></i></a>
						</div>
						<div class="pull-right">
							<a class="btn btn-success" href="<?php echo e(route('tesisDoctorales.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i></a>
						</div>
					</div>
				</div>

				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>
				<table class="table table-striped">
					<tr>
						<th><?php echo e(__('Izenburua')); ?></th>
						<th><?php echo e(__('Saila')); ?></th>
						<th><?php echo e(__('Ikerlaria(k)')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tesis): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a href="<?php echo e(route('tesisDoctorales.edit',$tesis->id)); ?>"><?php echo e($tesis->$titulo); ?></a>
							<br> <i>(<?php echo e($tesis->usuario?$tesis->usuario->name:''); ?> <?php echo e($tesis->usuario?$tesis->usuario->lname:''); ?>)</i>
						</td>
						<td>
							<?php echo e(\App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$tesis->departamento]??'---'); ?>

						</td>
						<td>
							<?php $__currentLoopData = $tesis->doctorandos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctorando): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 					<?php echo e($doctorando->nombre); ?> <?php echo e($doctorando->apellido); ?>

			 					<?php if(!$loop->last): ?>
			 						,
			 					<?php endif; ?>
			 				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('tesisDoctorales.edit',$tesis->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $tesis->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['tesisDoctorales.destroy', $tesis->id, $tesis->tipo],'style'=>'display:inline']); ?>

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
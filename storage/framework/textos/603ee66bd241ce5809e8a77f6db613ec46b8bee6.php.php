<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('postgrados', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<?php if( $tipo == 'master' ): ?>
								<h2><?php echo e(__('Masterretan parte-hartzea')); ?></h2>
    						<?php else: ?>
    							<h2><?php echo e(__('Doktoretza-programetan parte-hartzea')); ?></h2>
							<?php endif; ?>
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="<?php echo e(route('postgrados.indexAll', [ 'tipo'=> $tipo ])); ?>"><i class="fa fa-list" title="<?php echo e(__('Guztiak ikusi')); ?>"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('postgrados.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i></a>
						</div>

					</div>
				</div>

				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>

				<?php echo $__env->make('postgrados.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<table class="table">
					<tr>
						<th><?php echo e(__('Programa')); ?></th>
						<th><?php echo e(__('Kurtsoa')); ?></th>
						<th><?php echo e(__('Saila')); ?></th>
						<th><?php echo e(__('Data')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $postgrado): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $titulo = "titulo_".\Session::get('locale') ;?>
							<a  href="<?php echo e(route('postgrados.edit',$postgrado->id)); ?>"><?php echo e($postgrado->$titulo); ?></a>
							<br> <i>(<?php echo e($postgrado->usuario?$postgrado->usuario->name:''); ?> <?php echo e($postgrado->usuario?$postgrado->usuario->lname:''); ?>)</i>
						</td>
						<td>
							<?php $curso = "curso_".\Session::get('locale') ;?>
							<a  href="<?php echo e(route('postgrados.edit',$postgrado->id)); ?>"><?php echo e($postgrado->$curso); ?></a>
						</td>
						<td>
							<?php echo e(\App\Traits\Listados::listadoDepartamentos(\Session::get('locale'))[$postgrado->departamento]??'---'); ?>

						</td>
						<td>
							<?php echo e($postgrado->fecha); ?>

						</td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('postgrados.edit',$postgrado->id)); ?>"><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $postgrado->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['postgrados.destroy', $postgrado->id, $postgrado->tipo],'style'=>'display:inline']); ?>

								<?php echo e(Form::button('<i class="fa fa-trash"  title="'.__('Ezabatu').'"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger'] )); ?>

								<?php echo Form::close(); ?>

							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					<tr><td><?php echo e(__('Guztira:' )); ?> <?php echo e($data->total()); ?></td><td colspan ='3' class='text-center'><?php echo e($data->links()); ?></td><td><?php echo e(__('Oraingo orria:' )); ?> <?php echo e($data->currentPage()); ?></td></tr>
				</table>
			</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
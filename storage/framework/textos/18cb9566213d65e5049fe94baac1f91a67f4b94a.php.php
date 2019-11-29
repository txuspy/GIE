<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('divulgacion', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<?php if( $tipo == 'prensa' ): ?>
								<h2><?php echo e(__('Hedabideak')); ?></h2>
    						<?php else: ?>
    							<h2><?php echo e(__('Ekitaldiak')); ?></h2>
							<?php endif; ?>
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="<?php echo e(route('divulgacion.indexAll', [ 'tipo'=> $tipo ])); ?>"><i class="fa fa-list" title="<?php echo e(__('Hedakuntza guztiak ikusi')); ?>"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('divulgacion.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i> </a>
						</div>


					</div>
				</div>

				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>

				<?php echo $__env->make('divulgacion.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<table class="table">
					<?php if( $tipo == 'prensa' ): ?>
						<tr>
							<th><?php echo e(__('Izenburua')); ?></th>
							<th> </th>
							<th><?php echo e(__('Akzioak')); ?></th>
						</tr>
					<?php else: ?>
						<tr>
							<th colspan="2"><?php echo e(__('Izenburua')); ?></th>
							<!--<th><?php echo e(__('Deskripzioa')); ?></th>-->
							<th><?php echo e(__('Akzioak')); ?></th>
						</tr>
					<?php endif; ?>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $divulgacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<?php if( $tipo == 'prensa' ): ?>
							<td>
						<?php else: ?>
							<td colspan="2">
						<?php endif; ?>
							<?php 
							$titulo = "titulo_".\Session::get('locale') ;
							$desc = "desc_".\Session::get('locale') ;

							?>
							<a href="<?php echo e(route('divulgacion.edit',$divulgacion->id)); ?>"
							<?php if(Session::get('search')=='1'): ?>
								target="_blank"
							<?php endif; ?>
							><?php echo e($divulgacion->$titulo); ?></a>
							<br> ( <?php echo e($divulgacion->fecha); ?>  )
							<br> <i><?php echo e($divulgacion->usuario?$divulgacion->usuario->name:''); ?> <?php echo e($divulgacion->usuario?$divulgacion->usuario->lname:''); ?>

							 <?php echo e(\App\Traits\Listados::fechasIndex($divulgacion)); ?> </small></i>

						</td>
						<?php if( $tipo == 'prensa' ): ?>
							<td>
								<!--<a href="<?php echo e(route('divulgacion.edit',$divulgacion->id)); ?>"><?php echo e($divulgacion->$desc); ?></a>-->
								<?php echo e($divulgacion->web); ?> 
							</td>
						<?php endif; ?>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('divulgacion.edit',$divulgacion->id)); ?>"
							<?php if(Session::get('search')=='1'): ?>
								target="_blank"
							<?php endif; ?>
							>
								<i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $divulgacion->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['divulgacion.destroy', $divulgacion->id, $divulgacion->tipo],'style'=>'display:inline']); ?>

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
<?php echo e(\Session::put('search', '0')); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
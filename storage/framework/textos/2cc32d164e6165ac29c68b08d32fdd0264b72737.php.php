<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('ekintzak', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<?php if( $tipo == 'laguntza' ): ?>
								<h2><?php echo e(__('Bidelaguntza')); ?></h2>
    						<?php else: ?>
    							<h2><?php echo e(__('Formakuntza Osagarriak')); ?></h2>
							<?php endif; ?>
						</div>

						<div class="pull-right">
							<a class="btn btn-info" href="<?php echo e(route('ekintzak.indexAll', [ 'tipo'=> $tipo ])); ?>"><i class="fa fa-list" title="<?php echo e(__('Guztiak ikusi')); ?>"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('ekintzak.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i> </a>
						</div>


					</div>
				</div>

				<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
				<?php endif; ?>

				<?php echo $__env->make('ekintzak.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<table class="table">
					<tr>
						<th colspan="2"><?php echo e(__('Izenburua')); ?></th>
						<!--<th><?php echo e(__('Deskripzioa')); ?></th>-->
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ekintza): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td colspan="2">
							<?php
							$titulo = "titulo_".\Session::get('locale') ;
							$desc = "desc_".\Session::get('locale') ;

							?>
							<a href="<?php echo e(route('ekintzak.edit',$ekintza->id)); ?>"
							<?php if(Session::get('search')=='1'): ?>
								target="_blank"
							<?php endif; ?>
							><?php echo e($ekintza->$titulo); ?></a>
							<br> ( <?php echo e($ekintza->fecha); ?>  )
							<br> <i><?php echo e($ekintza->usuario?$ekintza->usuario->name:''); ?> <?php echo e($ekintza->usuario?$ekintza->usuario->lname:''); ?>

							 <?php echo e(\App\Traits\Listados::fechasIndex($ekintza)); ?> </small></i>

						</td>
<!--	
						<td>
							<a href="<?php echo e(route('ekintzak.edit',$ekintza->id)); ?>"><?php echo e($ekintza->$desc); ?></a>

						</td>
-->
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('ekintzak.edit',$ekintza->id)); ?>"
							<?php if(Session::get('search')=='1'): ?>
								target="_blank"
							<?php endif; ?>
							>
								<i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $ekintza->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['ekintzak.destroy', $ekintza->id, $ekintza->tipo],'style'=>'display:inline']); ?>

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
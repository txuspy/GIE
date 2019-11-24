<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('programasDeIntercambio', $tipo); ?>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-12 margin-tb">
						<div class="pull-left">
							<?php if( $tipo == 'PIfuera' ): ?>
								<h2><?php echo e(__('Beste unibertsitateetan')); ?></h2>
							<?php elseif( $tipo == 'PIvisita' ): ?>
								<h2><?php echo e(__('Bisitariak')); ?></h2>
							<?php elseif( $tipo == 'CEfuera' ): ?>
								<h2><?php echo e(__('Beste unibertsitateetan ')); ?></h2>
    						<?php else: ?>
    							<h2><?php echo e(__('Bisitariak')); ?></h2>
							<?php endif; ?>
<!--						
if( $tipo == 'PIfuera' ){
    $titu   = __('Elkartrukeko programak: IRI/AZPen mugikortasuna (Staff Movility)');
    $titulo = __('Beste unibertsitateetan');
}elseif($tipo == 'PIvisita'){
    $titu   = __('Elkartrukeko programak: IRI/AZPen mugikortasuna (Staff Movility)');
    $titulo = __('Bisitariak');
}elseif($tipo == 'CEfuera'){
    $titu   = __('Egonaldi zientifikoak'); 
    $titulo = __('Beste unibertsitateetan ');
}else{
    $titu   = __('Egonaldi zientifikoak'); 
    $titulo = __('Bisitariak');
} -->
						</div>
						<div class="pull-right">
							<a class="btn btn-info" href="<?php echo e(route('programasDeIntercambio.indexAll', [ 'tipo'=> $tipo  ])); ?>"><i class="fa fa-list" title="<?php echo e(__('Guztiak ikusi')); ?>"></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-info" href='' mostrarOcultar" onClick="$('#seccionSearch').toggle();return false;"  data-nomDiv="seccionSearch"><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>" ></i></a>
								&nbsp;
								&nbsp;
							<a class="btn btn-success" href="<?php echo e(route('programasDeIntercambio.create', [ 'tipo'=> $tipo ] )); ?>"><i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i></a>
						</div>





					</div>
				</div>

				<?php if($message = Session::get('success')): ?>
					<div class="alert alert-success">
						<p><?php echo e($message); ?></p>
					</div>
				<?php endif; ?>
				<?php echo $__env->make('programasDeIntercambio.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<table class="table">
					<tr>
						<th><?php echo e(__('Aktibitea')); ?></th>
						<th>
							<?php if( $tipo == 'enCasa' ): ?>
								<?php echo e(__('Jatorria')); ?>

							<?php else: ?>
								<?php echo e(__('Tokia')); ?>

							<?php endif; ?>
						</th>
						<th>
							<?php if( $tipo == 'azp' ): ?>
								<?php echo e(__('IIP / AZP')); ?>

							<?php else: ?>
								<?php echo e(__('Irakaslea(k)')); ?>

							<?php endif; ?>

						</th>
						<th><?php echo e(__('Data')); ?></th>
						<th><?php echo e(__('Akzioak')); ?></th>
					</tr>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $programaDeIntercambio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<tr>
						<td>
							<?php $activ = "actividad_".\Session::get('locale') ;?>

								<a  href="<?php echo e(route('programasDeIntercambio.edit',$programaDeIntercambio->id)); ?>"
								<?php if(Session::get('search')=='1'): ?>
									target="_blank"
								<?php endif; ?>
								>
									<?php echo e($programaDeIntercambio->$activ); ?>

									</a>
							<br> <i><small><?php echo e($programaDeIntercambio->usuario?$programaDeIntercambio->usuario->name:''); ?> <?php echo e($programaDeIntercambio->usuario?$programaDeIntercambio->usuario->lname:''); ?> <?php echo e(\App\Traits\Listados::fechasIndex($programaDeIntercambio)); ?><small></i>
						</td>
						<td><?php echo e($programaDeIntercambio->lugar); ?></td>
						<td>
							<?php $__currentLoopData = $programaDeIntercambio->profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 					<?php echo e($profesor->nombre); ?> <?php echo e($profesor->apellido); ?>

			 					<?php if(!$loop->last): ?>
			 						,
			 					<?php endif; ?>
			 				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
						</td>
						<td><?php echo e($programaDeIntercambio->desde); ?> / <?php echo e($programaDeIntercambio->hasta); ?></td>
						<td>
							<a class="btn btn-primary" href="<?php echo e(route('programasDeIntercambio.edit',$programaDeIntercambio->id)); ?>"
							<?php if(Session::get('search')=='1'): ?>
								target="_blank"
							<?php endif; ?>
							><i class="fa fa-pencil" title="<?php echo e(__('Aldadtu')); ?>"></i></a>
							<?php if( $programaDeIntercambio->user_id == \Auth::user()->id ): ?>
								<?php echo Form::open(['method' => 'DELETE','route' => ['programasDeIntercambio.destroy', $programaDeIntercambio->id, $programaDeIntercambio->tipo],'style'=>'display:inline']); ?>

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
<?php echo e(\Session::put('search', '0')); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
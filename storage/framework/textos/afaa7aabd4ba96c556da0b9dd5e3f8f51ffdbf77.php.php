<?php $__env->startSection('content'); ?>
@permission('permission-list')
<div class="container">
	<?php echo Breadcrumbs::render('permisos'); ?>


	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2><?php echo e(__('Permission Management')); ?> </h2>
				<div class="container">
					<a href="<?php echo e(url(App\Lib\Functions::parseLang().'/permisos/excel/xls')); ?>"><button class="btn btn-primary"><i class="fa fa-cloud-download" aria-hidden="true"></i> <?php echo e(__('Download xls')); ?> </button></a>
					<a href="<?php echo e(url(App\Lib\Functions::parseLang().'/permisos/excel/xlsx')); ?>"><button class="btn btn-info"><i class="fa fa-cloud-download" aria-hidden="true"></i> <?php echo e(__('Download xlsx')); ?></button></a>
					<a href="<?php echo e(url(App\Lib\Functions::parseLang().'/permisos/excel/cvs')); ?>"><button class="btn btn-warning"><i class="fa fa-cloud-download" aria-hidden="true"></i>  <?php echo e(__('Download CVS')); ?></button></a>
					<a href="<?php echo e(url(App\Lib\Functions::parseLang().'/permisos/pdf')); ?>"><button class="btn btn-default"><i class="fa fa-cloud-download" aria-hidden="true"></i>  <?php echo e(__('Download PDF')); ?></button></a>
				</div>
			</div>
			<div class="pull-right">
				@permission('permission-delete')
				<a class="btn btn-danger" href="#" id="borrarPermisos"> <?php echo e(__('Delete Permision')); ?> </a>
				@endpermission
				<br/>&nbsp;

			</div>
		</div>
	</div>
	<?php if($message = Session::get('success')): ?>
	<div class="alert alert-success">
		<p><?php echo e($message); ?></p>
	</div>
	<?php endif; ?>
	<?php if($message = Session::get('error')): ?>
	<div class="alert alert-success">
		<p><?php echo e($message); ?></p>
	</div>
	<?php endif; ?>
	<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger">
		<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="msj-insert" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> <?php echo e(__('Permission Created.')); ?></strong>
					</div>
					<div id="msj-deleted" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> <?php echo e(__('Permission Deleted.')); ?></strong>
					</div>
					<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
						<strong> <?php echo e(__('Upload ERROR.')); ?></strong>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th><?php echo e(__('Nombre')); ?></th>
								<th><?php echo e(__('Dysplay Name')); ?></th>
								<th><?php echo e(__('Descripción')); ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody id="datos">
							@permission('permission-create')
							<?php echo Form::open(); ?>

							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="token">
							<input type="hidden" name="_URL_BASE_DEFAULT" value="<?php echo e(env('URL_BASE_DEFAULT')); ?>" id="URL_BASE_DEFAULT">
							<tr>
								<td><?php echo Form::text('name', null, ['id' => 'name', 'class'=>'form-control', 'placeholder'=> ' Ingresa nombre']); ?>

								</td>
								<td>
									<?php echo Form::text('display_name', null, ['id' => 'display_name', 'class'=>'form-control', 'placeholder'=> ' Ingresa display name']); ?>

								</td>
								<td><?php echo Form::text('description', null, ['id' => 'description', 'class'=>'form-control', 'placeholder'=> ' Ingresa display name']); ?></td>
								<td><?php echo link_to('#', $title='Create New Permision', $attributes = ['id'=>'crearPermiso', 'class'=>'btn btn-success'] , $secure=null); ?></td>
							</tr>
							<?php echo Form::close(); ?>

							@endpermission
							<?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<tr id='linea<?php echo e($permiso->id); ?>'>
								<td scope="row"> <input type="checkbox" name="id_permiso[<?php echo e($loop->index +1); ?>]" id="id_permiso[<?php echo e($loop->index +1); ?>]" value="<?php echo e($permiso->id); ?>" /> <?php echo e($permiso->name); ?></td>
								<td><?php echo e($permiso->display_name); ?></td>
								<td><?php echo e($permiso->description); ?></td>
								<td><a href="/permisos/<?php echo e($permiso->id); ?>/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<tr><td><?php echo e(__('Total:' )); ?> <?php echo e($permisos->total()); ?></td><td colspan='2' class='text-center'><?php echo e($permisos->links()); ?></td><td><?php echo e(__('Pagina actual:' )); ?> <?php echo e($permisos->currentPage()); ?></td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endpermission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php echo Html::script('/js/permisos.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
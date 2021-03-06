<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('ekintzakAurretik', $tipo); ?>

	<div class="panel panel-default">
		<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<strong>Whoops!</strong> <?php echo e(__('Akats batzuk daude ')); ?><br><br>
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</ul>
			</div>
		<?php endif; ?>
		<div class="panel-body">
			<div class="col-sm-12 margin-tb">
				<div class="pull-left">
					<?php if( $tipo == 'aurretik' ): ?>
						<h2><?php echo e(__('Unibertsitate aurreko ikasleei bideratutako ekintzak')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Unibertsitate aurreko ikasleei bideratutako ekintzak')); ?></h2>
					<?php endif; ?>
				</div>
				<div class="pull-right">
					<a class="btn btn-primary" href="<?php echo e(route('ekintzakAurretik.index', ['tipo'  => $tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
				</div>
			</div>

	<?php echo Form::open(array('route' => 'ekintzakAurretik.store','method'=>'POST', 'class'=>'form' )); ?>

	<div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Izenburua (*):</strong></label>
				<?php if($errors->has('titulo_eu')): ?>
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				<?php endif; ?>
				<?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control ', 'data-tipo'  => $tipo)); ?>

			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Titulo (*):</strong></label>
				<?php if($errors->has('titulo_es')): ?>
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				<?php endif; ?>
				<?php echo Form::text('titulo_es', null, array('placeholder' => 'Izenburua','class' => 'form-control ', 'data-tipo'  => $tipo)); ?>

			</div>
		</div>
	   <div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Deskripzioa (*):</strong></label>
				<?php if($errors->has('desc_eu')): ?>
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				<?php endif; ?>
				<?php echo Form::textarea('desc_eu', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote', 'data-tipo'  => $tipo)); ?>


			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong>Descripción (*):</strong></label>
				<?php if($errors->has('desc_es')): ?>
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				<?php endif; ?>
				<?php echo Form::textarea('desc_es', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote', 'data-tipo'  => $tipo)); ?>

			</div>
		</div>
	</div>

	<div>
		<div class="col-sm-6 ">
			<div class="form-group has-error">
				<label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
				<?php if($errors->has('fecha')): ?>
					<i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
				<?php endif; ?>
				<?php echo Form::text('fecha',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

			</div>
		</div>
	</div>

	<div>
		<div class="col-sm-12 ">
			<p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
		</div>
	</div>
	<div>
		<div class="col-md-12 col-sm-12 col-md-12 text-center">
			<?php echo e(Form::hidden('tipo', $tipo)); ?>

			<?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

			<button type="submit" class="btn btn-success">
			   <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

			</button>
		</div>
	</div>
	<?php echo Form::close(); ?>

	</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						<?php echo e(trans('adminlte_lang::message.logged')); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
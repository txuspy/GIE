<?php $__env->startSection('content'); ?>
  	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2><?php echo e(__('Word Sortu')); ?></h2>
				</div>
			</div>
		</div>
	<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success">
			<p><?php echo e($message); ?></p>
		</div>
	<?php endif; ?>

	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<strong><?php echo e(__('Whoops!')); ?></strong> <?php echo e(__('There were some problems with your input.')); ?><br><br>
			<ul>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<li><?php echo e($error); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</ul>
		</div>
	<?php endif; ?>
		<div class="alert alert-success">
			<p><?php echo e(__('Urte oso bat, aukeratzen den urtetik aurrera izango da')); ?></p>
		</div>
	<?php echo Form::open(array('url' => App\Lib\Functions::parseLang().'/word' , 'method' => 'post', 'class' =>'form-horizontal')); ?>

<div style="margin:45px;">


	<div class="row" >
        <div class="col-xs-2">
             <div class="form-group  has-error">
	            <label><strong><?php echo e(__('Hasiera Data')); ?> (*):</strong></label>
	            <?php if($errors->has('desde')): ?>
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            <?php endif; ?>
	            <?php echo Form::text('desde', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->subYears(1)->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

	        </div>
        </div>
        <div class="col-xs-2">
             <div class="form-group  has-error">
	            <label><strong><?php echo e(__('Bukatze Data')); ?> (*):</strong></label>
	            <?php if($errors->has('hasta')): ?>
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            <?php endif; ?>
	            <?php echo Form::text('hasta', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

	        </div>
        </div>
    </div>

    <div class="row">
		<div class="col-xs-2 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Erabiltzaileak')); ?> :</strong></label>
				<p>Admin todos o seleccion  y profesor solo su usuario</p>
            </div>
        </div>
    </div>
 	<div class="row">
		<div class="col-xs-2 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Sekzio')); ?> :</strong></label>
				<p>Multiselect con cada tipo</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
			<button type="submit" class="btn btn-primary"><i class="fa fa-plus" title ="<?php echo e(__('Word sortu')); ?>"></i> <?php echo e(__('Word sortu')); ?></button>
        </div>
        <script type="text/javascript">
			$('.date-year').datepicker({
			    minViewMode: 2,
			    format     : 'yyyy',
			});
			$('.date-mes').datepicker({
			    minViewMode: 1,
			    format     : 'mm',
			    language: "<?php echo e(\Session::get('locale')); ?>"
			});
		</script>
	<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
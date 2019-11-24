<?php $__env->startSection('content'); ?>
   <?php echo Breadcrumbs::render('ekintzakEdit', $ekintza); ?>

   <div class="panel panel-default">
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
		<div class="panel-body">
			<div class="col-sm-12 margin-tb">
		        <div class="pull-left">
		        	<?php if( $ekintza->tipo == 'laguntza' ): ?>
						<h2><?php echo e(__('Bidelaguntza')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Formakuntza Osagarriak')); ?></h2>
					<?php endif; ?>
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('ekintzak.index', ['tipo'  => $ekintza->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo Form::model($ekintza, ['method' => 'PUT','route' => ['ekintzak.update', $ekintza->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Izenburua (*):</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo:</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Deskripzioa (*):</strong></label>
		                <?php echo Form::textarea('desc_eu', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Descripción:</strong></label>
		                <?php echo Form::textarea('desc_es', null, array('placeholder' => 'Descripción','class' => 'form-control summernote')); ?>

		            </div>

		        </div>
		    </div>
		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Data')); ?> (*):</strong>  </label>
		                <?php echo Form::text('fecha',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>

		    </div>
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				<?php echo e(Form::hidden('tipo', $ekintza->tipo)); ?>

				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
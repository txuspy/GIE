<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('congresos'); ?>

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
    	            <h2><?php echo e(__('Kongresu Zientifikoetan parte-hartzea')); ?></h2>
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="<?php echo e(route('congresos.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
    	        </div>
    	    </div>
        	<?php echo Form::open(array('route' => 'congresos.store','method'=>'POST', 'class'=>'form' )); ?>

        	<div>
        		<div class="col-sm-6 ">
                    <div class="form-group has-success">
                        <label><strong><?php echo e(_('Kongresua')); ?> (*):</strong></label>
                        <?php echo Form::text('congreso_eu', null, array('placeholder' => _('Kongresua') ,'class' => 'form-control buscadorCongresos')); ?>

                    </div>
                </div>
                <div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong><?php echo e(('Izenburua')); ?> (*):</strong></label>
                        <?php echo Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburua') ,'class' => 'form-control')); ?>

                    </div>
                </div>
            </div>
            <div>
                <div class="col-sm-6 ">
                    <div class="form-group has-success">
                        <label><strong><?php echo e(__('Ekarpen mota')); ?> (*):</strong></label>
                        <?php echo Form::select('ekarpena', ['1' => __('Hitzaldi gonbidatua / Ponencia invitada'), '2' => __('Ahozkoaurkezpena / Comunicación oral'), '3' => __('Posterra / Poster') ], 1 , ['class' => 'form-control chosen-type']); ?>

                    </div>
                </div>
                 <div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
                        <?php echo Form::text('lugar', null, array('placeholder' => __('Viena, Austria'),'class' => 'form-control')); ?>

                    </div>
                </div>
            </div>
            <div>
                <div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong><?php echo e(__('Noiztik')); ?> (*):</strong></label>
                        <?php echo Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

                    </div>
                </div>
        		<div class="col-sm-6 ">
                     <div class="form-group has-success">
                        <label><strong><?php echo e(__('Arte')); ?> (*):</strong></label>
                        <?php echo Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')); ?>

                    </div>
                </div>
            </div>
            <p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
            <div class="row">
                <div class="col-sm-12 col-sm-12 col-md-12 text-center">
                   	<button type="submit" class="btn btn-success">
                        <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

                    </button>
                </div>
        	</div>

        	<?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

        	<?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('equipamientoNuevoEdit', $equipamientoNuevo); ?>

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
                	<h2><?php echo e(__('Hornikuntza Zientifikoa eskuratzea')); ?></h2>
                </div>
                <div class="pull-right">
                <a class="btn btn-primary" href="<?php echo e(route('equipamientoNuevo.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
                </div>
            </div>

	<?php echo Form::model($equipamientoNuevo, ['method' => 'PATCH','route' => ['equipamientoNuevo.update', $equipamientoNuevo->id]]); ?>

	<div>

        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Hornikuntza')); ?>:</strong></label>
                <?php echo Form::text('hornikuntza', null, array('placeholder' => 'Taldea','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Ekipamendua')); ?>:</strong></label>
                <?php echo Form::text('ekipamendua', null, array('placeholder' => 'Equipo','class' => 'form-control')); ?>

            </div>
        </div>

    </div>
    <div>

        <div class="col-sm-6 ">
           <div class="form-group">
                <label><strong><?php echo e(__('Saila')); ?> :</strong></label>
                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $equipamientoNuevo->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Instituzioa')); ?> :</strong></label>
                <?php echo Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')); ?>

            </div>
        </div>
    </div>
	<div>
	    <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Data')); ?> :</strong></label>
                <?php echo Form::text('data',  null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')); ?>

            </div>
        </div>

         <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Zenbateko')); ?> :</strong><small>(€)</small></label>
                <?php echo Form::text('importe', null, array('placeholder' => __('Zenbateko'),'class' => 'form-control')); ?>

            </div>
        </div>
    </div>

    <div>
    <div class="col-md-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
    </div>
	<?php echo Form::close(); ?>

	</div>
		</div>	</div>
	<script type="text/javascript">
      $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
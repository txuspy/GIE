<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('equipamientoNuevo'); ?>

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
                	<h2><?php echo e(__('Hornikuntza Zientifikoa eskuratzea')); ?></h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="<?php echo e(route('equipamientoNuevo.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
                </div>
            </div>
	        <?php echo Form::open(array('route' => 'equipamientoNuevo.store','method'=>'POST', 'class'=>'form' )); ?>

        	    <div>
            		<div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>Hornikuntza (*):</strong></label>
                            <?php echo Form::text('equipo_eu', null, array('placeholder' => 'Hornikuntza','class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Equipamiento:</strong></label>
                            <?php echo Form::text('equipo_es', null, array('placeholder' => 'Equipamiento','class' => 'form-control')); ?>

                        </div>
                    </div>
                </div>
            	<div>
            		<div class="col-sm-6 ">
                       <div class="form-group has-success">
                            <label><strong>Saila/ Departamento (*):</strong></label>
                            <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong><?php echo e(__('Instituzioa')); ?> (*):</strong></label>
                            <?php echo Form::text('institucion', null, array('placeholder' => __('Instituzioa') ,'class' => 'form-control')); ?>

                        </div>
                    </div>
                </div>
            	<div>

                    <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
                            <?php echo Form::text('data',  null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong><?php echo e(__('Zenbateko')); ?> :</strong></label>
                            <?php echo Form::text('importe', null, array('placeholder' => __('Zenbateko'),'class' => 'form-control')); ?>

                        </div>
                    </div>
                </div>
                 <p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
                <div>
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
    <script type="text/javascript">
      $('.date-year').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
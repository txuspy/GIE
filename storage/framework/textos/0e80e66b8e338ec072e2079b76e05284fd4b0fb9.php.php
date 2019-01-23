<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('programasDeIntercambio', $tipo); ?>

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
    	           	<?php if( $tipo == 'fuera' ): ?>
    					<h2><?php echo e(__('Egonaldi zientifikoak beste Unibertsitateetan')); ?></h2>
    				<?php elseif( $tipo == 'azp' ): ?>
    					<h2><?php echo e(__('IIP / AZPren mugikortasuna')); ?></h2>
    				<?php else: ?>
    					<h2><?php echo e(__('Etorritako ikerlariak')); ?></h2>
    				<?php endif; ?>
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="<?php echo e(route('programasDeIntercambio.index', ['tipo'  => $tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
    	        </div>
    	    </div>

        	<?php echo Form::open(array('route' => 'programasDeIntercambio.store','method'=>'POST', 'class'=>'form' )); ?>

        	<div>
        		<div class="col-sm-6 ">
                      <div class="form-group has-error">
                        <label><strong>Aktibitatea(*):</strong></label>
                        <?php if($errors->has('actividad_eu')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
                        <?php echo Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control', 'data-tipo'  => $tipo )); ?>

                    </div>
                </div>

                <div class="col-sm-6 ">
                    <div class="form-group">
                        <label><strong>Actividad :</strong></label>
                        <?php echo Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control', 'data-tipo'  => $tipo )); ?>

                    </div>
                </div>


            </div>

            <div>
                <div class="col-sm-6 ">
                      <div class="form-group has-error">
                        <label><strong><?php echo e(__('Noiztik')); ?> (*):</strong></label>
                        <?php if($errors->has('desde')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
                        <?php echo Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

                    </div>
                </div>
        		<div class="col-sm-6 ">
                    <div class="form-group">
                        <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
                        <?php echo Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addMonths(6)->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

                    </div>
                </div>
            </div>

<div class="col-sm-6 ">
                      <div class="form-group has-error">
                        <label><strong>
                            <?php if( $tipo == 'enCasa' ): ?>
								<?php echo e(__('Jatorria')); ?>

							<?php else: ?>
								<?php echo e(__('Tokia')); ?>

							<?php endif; ?>
                             (*):</strong></label>
                        <?php if($errors->has('lugar')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
                        <?php echo Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control')); ?>

                    </div>
                </div>
                <div>
                    <div class="col-sm-12">
                        <p ><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
                    </div>
                </div>
                 <div>
                <div class="col-sm-12 col-sm-12 col-md-12 text-center">
                    <?php echo e(Form::hidden('tipo', $tipo)); ?>

                    <?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

        			<button type="submit" class="btn btn-success">
        			   <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

        		    </button>
                </div>
        	</div>
            </div>





        	<?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
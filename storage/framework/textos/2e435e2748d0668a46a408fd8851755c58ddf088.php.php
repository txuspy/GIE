<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('grupoInvestigacion'); ?>

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
                	<h2><?php echo e(__('Ikerkuntza taldea')); ?></h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="<?php echo e(route('grupoInvestigacion.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
                </div>
            </div>
        	<?php echo Form::open(array('route' => 'grupoInvestigacion.store','method'=>'POST', 'class'=>'form' )); ?>

            	<div>
            	     <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>Taldea *:</strong></label>
                            <?php echo Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control buscadorGrupoInvestigacion')); ?>

                        </div>
                    </div>
            		<div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Grupo:</strong></label>
                            <?php echo Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control buscadorGrupoInvestigacion')); ?>

                        </div>
                    </div>

                </div>
            	<div>

                     <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong>Ikerkuntza lerroak *:</strong></label>
                            <?php echo Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control')); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="form-group">
                            <label><strong>Líneas de investigación :</strong></label>
                            <?php echo Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control')); ?>

                        </div>
                    </div>
                </div>


                <div>
                    <div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong><?php echo e(__('Noiztik')); ?> *:</strong></label>
                            <?php echo Form::text('desde',  null , array('placeholder' => __('Noiztik') ,'class' => 'date-year form-control')); ?>

                        </div>
                    </div>
            		<div class="col-sm-6 ">
                        <div class="form-group has-success">
                            <label><strong><?php echo e(__('Arte')); ?> *:</strong></label>
                            <?php echo Form::text('hasta', null , array('placeholder' => __('Hutsik utzi gaur egun martxan badago') ,'class' => 'date-year form-control')); ?>

                        </div>
                    </div>
                </div>
                <p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
                <div>
                    <div class="col-md-12 col-sm-12 col-md-12 text-center">
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
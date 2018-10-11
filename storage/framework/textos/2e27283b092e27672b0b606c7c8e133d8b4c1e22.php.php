<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('formaciones', $tipo, $modo); ?>

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
		           	<?php if( $tipo == 'libros' ): ?>
						<h2><?php echo e(__('Liburuak eta Monografiak')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Artikuloak')); ?></h2>
					<?php endif; ?>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('formaciones.index', ['tipo'  => $tipo , 'modo'  => $modo])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
	        </div>

			<?php echo Form::open(array('route' => 'formaciones.store','method'=>'POST', 'class'=>'form' )); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong>Ikastaro (*):</strong></label>
		                 <?php if($errors->has('titulo_eu')): ?>
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    <?php endif; ?>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Kurtsoa','class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Curso :</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

		            </div>
		        </div>
		    </div>
			<?php if( $modo == 'recibir' ): ?>
			    <div>
					<div class="col-sm-6 ">
			            <div class="form-group has-error">
			                <label><strong>Antolatzailea(k) (*):</strong></label>
			                <?php if($errors->has('organizador_eu')): ?>
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    <?php endif; ?>
			                <?php echo Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es) :</strong></label>
			                <?php echo Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

			            </div>
			        </div>
			    </div>
			<?php endif; ?>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
		                <?php if($errors->has('fecha')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker  form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Tokia')); ?> :</strong></label>
		                <?php echo Form::text('lugar', null, array('placeholder' => __('Tokia') ,'class' => 'form-control ')); ?>

		            </div>
		        </div>

		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Iraupena')); ?> : </strong></label><small>(<?php echo e(__('orduak')); ?>)</small>
		                <?php echo Form::text('duracion', null, array('placeholder' => '10' ,'class' => 'form-control ')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
                <div class="col-sm-12">
		    		<p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
		    	</div>
	    	</div>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">
		            <?php echo e(Form::hidden('tipo', $tipo)); ?>

		            <?php echo e(Form::hidden('modo', $modo)); ?>

		            <?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

					<button type="submit" class="btn btn-success">
					   <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

				    </button>
		        </div>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
    <script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
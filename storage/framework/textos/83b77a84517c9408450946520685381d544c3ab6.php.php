<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('postgrados', $tipo); ?>

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
		           	<?php if( $tipo == 'master' ): ?>
						<h2><?php echo e(__('Masterretan parte-hartzea')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Doktoretza-programetan parte-hartzea')); ?></h2>
					<?php endif; ?>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('postgrados.index', ['tipo'  => $tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
	        </div>

			<?php echo Form::open(array('route' => 'postgrados.store','method'=>'POST', 'class'=>'form' )); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>Programa (*):</strong></label>
		                <?php if($errors->has('titulo_eu')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Programa','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)); ?>

		            </div>

		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Programa :</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Programa','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)); ?>

		            </div>
		        </div>
		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong>Kurtsoa (*):</strong></label>
		                <?php if($errors->has('curso_eu')): ?>
	                       <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>

		                <?php echo Form::text('curso_eu', null, array('placeholder' => 'Kurtsoa','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Curso :</strong></label>
		                <?php echo Form::text('curso_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorPostgrados', 'data-tipo'  => $tipo)); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
                   <div class="form-group  has-error">
                        <label><strong><?php echo e(__('Saila')); ?> (*):</strong> </label>
                        <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

                    </div>
                </div>
                <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong><?php echo e(__('Iraupena')); ?> (*):</strong></label>
		                <?php if($errors->has('duracion')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>

		                <?php echo Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')); ?>

		            </div>

		        </div>
		    </div>
		    <div>

                <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
		                 <?php if($errors->has('lugar')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('lugar', 'Gipuzkoako Ingeniaritza Eskola', array('placeholder' => '15 ECTS','class' => 'form-control ')); ?>

		            </div>
		        </div>
		         <div class="col-sm-6 ">
		            <div class="form-group  has-error">
		                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
		                <?php if($errors->has('fecha')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('fecha', null, array('placeholder' => __('Data'),'class' => 'datepicker form-control ')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
                <div class="col-sm-12 ">
			   		 <p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
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
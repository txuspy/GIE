<?php $__env->startSection('content'); ?>
	<?php echo Breadcrumbs::render('tesisDoctorales', $tipo); ?>

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
    	            <?php if($tipo == 'proximaLectura'): ?>
    					<h2><?php echo e(__('Uneko Tesiak')); ?></h2>
    				<?php else: ?>
    					<h2><?php echo e(__('Tesiak')); ?></h2>
    				<?php endif; ?>
    	        </div>
    	        <div class="pull-right">
    	            <a class="btn btn-primary" href="<?php echo e(route('tesisDoctorales.index', ['tipo'  => $tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
    	        </div>
    	    </div>


	<?php echo Form::open(array('route' => 'tesisDoctorales.store','method'=>'POST', 'class'=>'form' )); ?>

	<div>
		<div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong>Izenburua / Titulo (*):</strong></label>
                <?php if($errors->has('titulo_eu')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')); ?>

            </div>

        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>
        <!--
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorTesisDoctorales')); ?>

            </div>
        </div>
        -->
    </div>
	<div>
        <div class="col-sm-6 ">
            <div class="form-group has-error">
                <label><strong> <?php echo e(__('Saila')); ?> (*):</strong></label>
                <?php if($errors->has('departamento')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '54', ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

            </div>
        </div>

        <div class="col-sm-2">
           <?php echo e(Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('euskera', 1, '', ['class' => ''])); ?>

        </div>
        <div class="col-sm-2">
           <?php echo e(Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('internacional', 1, '', ['class' => ''])); ?>

        </div>
     </div>
     <div>
        <div class="col-sm-2">
            <div class="form-group has-error">
                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
                <?php if($errors->has('fechaLectura')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('fechaLectura', date('Y') , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y') ,'class' => 'datepicker date-year form-control')); ?>

            </div>
        </div>

    <p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
    <div>
        <div class="col-md-12 col-sm-12 col-md-12 text-center">
            <?php echo e(Form::hidden('tipo', $tipo)); ?>

            <?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>


			<button type="submit" class="btn btn-success">
			   <i class="fa fa-plus" title ="<?php echo e(__('Berria sortu')); ?>"></i> <?php echo e(__('Jarraitu')); ?>

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
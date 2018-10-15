<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('congresosEdit', $congreso); ?>

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
		            <h2><?php echo e(__('Kongresu Zientifikoetan parte-hartzea')); ?></h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('congresos.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
    	</div>
		<?php echo $__env->make('layouts.dialog', [
			'idDialog' => "dialogCongresoProfesor",
			'idForm'=>'formdialogCongresoProfesor',
			'tituloContenido' => __('Irakasle berria sortu') ,
		], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo Form::model($congreso, ['method' => 'PATCH','route' => ['congresos.update', $congreso->id]]); ?>

		<div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Kongresua')); ?>:</strong></label>
	                <?php echo Form::text('congreso_eu', null, array('placeholder' => 'Grupo','class' => 'form-control')); ?>

	            </div>
	        </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Izenburua')); ?> :</strong></label>
	                <?php echo Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburuaa') ,'class' => 'form-control')); ?>

	            </div>
	        </div>
	    </div>
		<div>
			<div class="col-xs-6 ">
		      	 <div class="form-group has-error">
		                <label><strong><?php echo e(__('Ekarpen mota')); ?> (*):</strong></label>

		                <?php echo Form::select('ekarpena',  \App\Traits\Listados::listadoEkarpena(), $congreso->ekarpena , ['id' =>'ekarpena',   'class' => 'form-control chosen-select']); ?>


		         </div>
	         </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Tokia')); ?> :</strong></label>
	                <?php echo Form::text('lugar', null, array('placeholder' => __('Viena, Austria'),'class' => 'form-control')); ?>

	            </div>
	        </div>
	    </div>
	    <div>
	        <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Noiztik')); ?> :</strong></label>
	                <?php echo Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

	            </div>
	        </div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Arte')); ?> :</strong></label>
	                <?php echo Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')); ?>

	            </div>
	        </div>
	    </div>

	    <div>
	    	<div class="col-md-6 ">
	    		<label><strong><?php echo e(__('Irakaslea(k)')); ?>:</strong></label>
	    	 	<?php echo e(Form::text('CongresoProfesor', '', [
			        'id'           =>'CongresoProfesor',
			        'placeholder'  =>__('Irakaslea bilatu'),
			        'class'        =>'form-control buscadorAutor inputAutores',
			        'data-idDialog'=>'dialogCongresoProfesor',
			        'data-carpeta' =>'profesor',
			        'data-tipo'    =>'congresos',
			        'data-idUl'    =>'ulCongresoProfesor',
			        'data-id'      => $congreso->id
	    	 	]
	    	 	)); ?>

		 		<br><ul id="ulCongresoProfesor" class="list-group">
		 			<?php $__currentLoopData = $congreso->profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		 				<li class="list-group-item" id="detachProfesor<?php echo e($profesor->id); ?>">
			 				<a data-id='<?php echo e($congreso->id); ?>' data-idAutor='<?php echo e($profesor->id); ?>' data-carpeta ='profesor' data-tipo='congresos'  class='desenlazar'>
			 					<i class="fa fa-trash"></i>
			 				</a>
		 				<?php echo e($profesor->nombre); ?> <?php echo e($profesor->apellido); ?>

		 				</li>
		 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		 		</ul>
		 	</div>

		</div>
	    <div class="col-md-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
		</div>
		<?php echo Form::close(); ?>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
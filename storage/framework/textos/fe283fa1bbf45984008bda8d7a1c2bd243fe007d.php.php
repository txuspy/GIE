<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('visitasEdit', $visita); ?>

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
		           	<h2><?php echo e(__('Bisitak')); ?></h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('visitas.index' )); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogVisitasAutores",
				'idForm'=>'formdialogVisitasAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo Form::model($visita, ['method' => 'PUT','route' => ['visitas.update', $visita->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Aktibitatea:</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad:</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
		                <?php echo Form::text('lugar', null , array('placeholder' => __('Tokia') ,'class' => ' form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
		                <?php echo Form::text('fecha', null , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
		    </div>

		    <div>
		    	<div class="col-sm-6">
		    		<label><strong><?php echo e(__('Irakaslea(k)')); ?>:</strong></label>
		    	 	<?php echo e(Form::text('visitasAutores', '', [
				        'id'           =>'visitasAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogVisitasAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'visitas',
				        'data-idUl'    =>'ulVisitasAutores',
				        'data-id'      => $visita->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulVisitasAutores" class="list-group">
			 			<?php $__currentLoopData = $visita->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachAutores<?php echo e($autor->id); ?>">
				 				<a data-id='<?php echo e($visita->id); ?>' data-idAutor='<?php echo e($autor->id); ?>' data-carpeta ='autores' data-tipo='publicaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($autor->nombre); ?> <?php echo e($autor->apellido); ?>

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
	</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
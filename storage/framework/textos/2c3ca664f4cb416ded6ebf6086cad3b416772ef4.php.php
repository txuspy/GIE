<?php $__env->startSection('content'); ?>
   <?php echo Breadcrumbs::render('programasDeIntercambioEdit', $programaDeIntercambio); ?>

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
		           	<?php if( $programaDeIntercambio->tipo == 'fuera' ): ?>
						<h2><?php echo e(__('Egonaldi zientifikoak beste Unibertsitateetan')); ?></h2>
					<?php elseif( $programaDeIntercambio->tipo  == 'azp' ): ?>
						<h2><?php echo e(__('IIP / AZPren mugikortasuna')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Etorritako ikerlariak')); ?></h2>
					<?php endif; ?>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('programasDeIntercambio.index', ['tipo'  => $programaDeIntercambio->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogProgramaDeIntercambioProfesores",
				'idForm'=>'formdialogProgramaDeIntercambioProfesores',
				'tituloContenido' => __('Irakaslea berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo Form::model($programaDeIntercambio, ['method' => 'PUT','route' => ['programasDeIntercambio.update', $programaDeIntercambio->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Aktibitatea:(*):</strong></label>
		                <?php echo Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad:</strong></label>
		                <?php echo Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>
		                	<?php if( $programaDeIntercambio->tipo == 'enCasa' ): ?>
								<?php echo e(__('Jatorria')); ?>

							<?php else: ?>
								<?php echo e(__('Tokia')); ?>

							<?php endif; ?>
							(*):</strong></label>
		                <?php echo Form::text('lugar', null, array('placeholder' => __('Tokia') ,'class' => 'form-control')); ?>

		            </div>
		        </div>


		        <div class="col-sm-3">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Noiztik')); ?> (*):</strong></label>
		                <?php echo Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-3">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
		                <?php echo Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>
		    		<?php if( $programaDeIntercambio->tipo  == 'azp' ): ?>
						<?php echo e(__('IIP / AZP')); ?> (*):
					<?php else: ?>
						<?php echo e(__('Irakaslea(k)')); ?> (*):
					<?php endif; ?>
		    			</strong><span class='autorInfo'></span> </label>
		    	 	<?php echo e(Form::text('programaDeIntercambioProfesores', '', [
				        'id'           =>'programaDeIntercambioProfesores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogProgramaDeIntercambioProfesores',
				        'data-carpeta' =>'profesor',
				        'data-tipo'    =>'programasDeIntercambio',
				        'data-idUl'    =>'ulProgramaDeIntercambioProfesores',
				        'data-id'      => $programaDeIntercambio->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulProgramaDeIntercambioProfesores" class="list-group">
			 			<?php $__currentLoopData = $programaDeIntercambio->profesores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profesor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachProfesores<?php echo e($profesor->id); ?>">
				 				<a data-id='<?php echo e($programaDeIntercambio->id); ?>' data-idAutor='<?php echo e($profesor->id); ?>' data-carpeta ='profesor' data-tipo='programasDeIntercambio'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($profesor->nombre); ?> <?php echo e($profesor->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>
			</div>
	        <div class="col-sm-10 col-sm-10 col-md-10 text-center">
	        	<?php echo e(Form::hidden('tipo', $programaDeIntercambio->tipo)); ?>

				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
	        </div>
			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
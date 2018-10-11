<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('formacionesEdit', $formacion); ?>

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
		           	<h2>
						<?php if( $formacion->tipo == 'PDI' ): ?>
							<?php echo e(__('IIPko formazioa')); ?>

						<?php else: ?>
							<?php echo e(__('AZKko formazioa')); ?>

						<?php endif; ?>
						<?php if( $formacion->modo == 'recibir' ): ?>
							- <?php echo e(__('Hartutakoa')); ?>

						<?php else: ?>
							- <?php echo e(__('Emandakoa')); ?>

						<?php endif; ?>
					</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('formaciones.index', ['tipo'  => $formacion->tipo, 'modo'  => $formacion->modo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogFormacionesAutores",
				'idForm'=>'formdialogFormacionesAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo Form::model($formacion, ['method' => 'PUT','route' => ['formaciones.update', $formacion->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Ikastaro:</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Curso:</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
		    <?php if( $formacion->modo == 'recibir' ): ?>
			     <div>
					<div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Antolatzailea(k):</strong></label>
			                <?php echo Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control buscadorformaciones')); ?>

			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es) :</strong></label>
			                <?php echo Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control buscadorformaciones')); ?>

			            </div>
			        </div>
			    </div>
			<?php endif; ?>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Hasiera-Data')); ?> :</strong></label>
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
		                <label><strong><?php echo e(__('Iraupena')); ?> :</strong></label>
		                <?php echo Form::text('duracion', null, array('placeholder' => __('Iraupena') ,'class' => 'form-control ')); ?>

		            </div>
		        </div>
		    </div>

		    <div>
		    	<div class="col-sm-6">
		    		<label><strong>
		    				<?php if( $formacion->modo == 'recibir' ): ?>
								<?php echo e(__('Parte-hartzailea(k)')); ?>

							<?php else: ?>
								<?php echo e(__('Hizlaria(k)')); ?>

							<?php endif; ?>
						</strong></label>
		    	 	<?php echo e(Form::text('formacionesAutores', '', [
				        'id'           =>'formacionesAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogFormacionesAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'formaciones',
				        'data-idUl'    =>'ulFormacionesAutores',
				        'data-id'      => $formacion->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulFormacionesAutores" class="list-group">
			 			<?php $__currentLoopData = $formacion->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachAutores<?php echo e($autor->id); ?>">
				 				<a data-id='<?php echo e($formacion->id); ?>' data-idAutor='<?php echo e($autor->id); ?>' data-carpeta ='autores' data-tipo='formaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($autor->nombre); ?> <?php echo e($autor->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	<?php echo e(Form::hidden('tipo', $formacion->tipo)); ?>

		        	<?php echo e(Form::hidden('modo', $formacion->modo)); ?>

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
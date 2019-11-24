<?php $__env->startSection('content'); ?>
   <?php echo Breadcrumbs::render('proyectosEdit', $proyecto); ?>

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
		        	<?php if( $proyecto->tipo == 'europa' ): ?>
						<h2><?php echo e(__('Europar Batasuneko Programa Markoa')); ?></h2>
					<?php elseif($proyecto->tipo == 'erakundeak'): ?>
						<h2><?php echo e(__('Erakundeek diruz lagundutako ikerkuntza Proiektuak')); ?></h2>
		   			<?php else: ?>
						<h2><?php echo e(__('Enpresek diruz lagundutako ikerkuntza Proiektuak')); ?></h2>
					<?php endif; ?>
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('proyectos.index', ['tipo'  => $proyecto->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogProyectosDirector",
				'idForm'=>'formdialogProyectosDirector',
				'tituloContenido' => __('Zuzendari berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogProyectosInvestigador",
				'idForm'=>'formdialogProyectosInvestigador',
				'tituloContenido' => __('Doctorando berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::model($proyecto, ['method' => 'PUT','route' => ['proyectos.update', $proyecto->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Proiektua (*):</strong></label>
		                <?php echo Form::text('proyecto_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Proyecto:</strong></label>
		                <?php echo Form::text('proyecto_es', null, array('placeholder' => 'Titulo','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Finantziazioa')); ?> (*):</strong></label>
		                <?php echo Form::text('financinacion', null, array('placeholder' => __('Finantziazioa') ,'class' => 'form-control')); ?>

		            </div>
		        </div>
				<div style="clear:both;"></div>
		    </div>
		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Noiztik')); ?> (*):</strong> </label>
		                <?php echo Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
		                <?php echo Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><strong><?php echo e(__('Ikertzaile nagusia(k)')); ?> (*):</strong><span class='autorInfo'></span></label>
		    	 	<?php echo e(Form::text('proyectosDirector', '', [
				        'id'           =>'proyectosDirector',
				        'placeholder'  =>__('Ikertzaile nagusia bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogProyectosDirector',
				        'data-carpeta' =>'director',
				        'data-tipo'    =>'proyectos',
				        'data-idUl'    =>'ulProyectosDirector',
				        'data-id'      => $proyecto->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulProyectosDirector" class="list-group">
			 			<?php $__currentLoopData = $proyecto->directores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachDirector<?php echo e($director->id); ?>">
				 				<a data-id='<?php echo e($proyecto->id); ?>' data-idAutor='<?php echo e($director->id); ?>' data-carpeta ='director' data-tipo='proyectos'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($director->nombre); ?> <?php echo e($director->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>
			 	<div class="col-sm-6 ">
		    		<label><strong><?php echo e(__('Partaidea(k)')); ?> (*):</strong></label>
		    	 	<?php echo e(Form::text('proyectosInvestigador', '', [
			         'id'           =>'proyectosInvestigador',
			         'placeholder'  =>__('Partaideak bilatu'),
			         'class'        =>'form-control buscadorAutor inputAutores' ,
			         'data-idDialog'=>'dialogProyectosInvestigador',
			         'data-carpeta' =>'doctorando',
			         'data-tipo'    =>'proyectos',
			         'data-idUl'    =>'ulProyectosInvestigador',
			         'data-id'      => $proyecto->id
			        ])); ?>

			 		<br><ul id="ulProyectosInvestigador" class="list-group">
			 			<?php $__currentLoopData = $proyecto->investigadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investigador): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item"  id="detachDoctorando<?php echo e($investigador->id); ?>">
			 					<a data-id='<?php echo e($proyecto->id); ?>' data-idAutor='<?php echo e($investigador->id); ?>' data-carpeta ='doctorando' data-tipo='proyectos'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 					<?php echo e($investigador->nombre); ?> <?php echo e($investigador->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>
		 	</div>
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				<?php echo e(Form::hidden('tipo', $proyecto->tipo)); ?>

				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
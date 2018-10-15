<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('publicacionesEdit', $publicacion); ?>

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
		           	<?php if( $publicacion->tipo == 'libros' ): ?>
						<h2><?php echo e(__('Liburuak eta Monografiak')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Artikuloak')); ?></h2>
					<?php endif; ?>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('publicaciones.index', ['tipo'  => $publicacion->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogPublicacionesAutores",
				'idForm'=>'formdialogPublicacionesAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo Form::model($publicacion, ['method' => 'PUT','route' => ['publicaciones.update', $publicacion->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Izenburua')); ?>:</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">

		           <?php if( $publicacion->tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('Argitaletxea')); ?> :</strong></label>
			                <?php echo Form::text('editorialRevisa',  null , array('placeholder' => __('Argitaletxea') ,'class' => 'buscadorAldikariak form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('Aldizkaria')); ?> :</strong></label>
		                	<?php echo Form::text('editorialRevisa',  null , array('placeholder' => __('Aldizkaria') ,'class' => 'form-control buscadorAldikariak')); ?>

		            	</div>
		            <?php endif; ?>


		        </div>
		        
		    </div>

		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		        	<?php if( $publicacion->tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('Kapitulo')); ?> :</strong></label>
			                <?php echo Form::text('capitulo',  null , array('placeholder' => __('Kapitulo') ,'class' => ' form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('Bolumena')); ?> :</strong></label>
		                	<?php echo Form::text('volumen',  null , array('placeholder' => __('Bolumena') ,'class' => ' form-control')); ?>

		            	</div>
		            <?php endif; ?>
		        </div>
		         <div class="col-sm-6 ">
		        	<?php if( $publicacion->tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('ISBN')); ?> :</strong></label>
			                <?php echo Form::text('ISBN',  null , array('placeholder' => __('ISBN') ,'class' => ' form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('ISSN')); ?> :</strong></label>
		                	<?php echo Form::text('ISBN',  null , array('placeholder' => __('ISSN') ,'class' => ' form-control')); ?>

		            	</div>
		            <?php endif; ?>
		        </div>


		    </div>
		    <div>
		    	<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Data')); ?> :</strong></label>
		                <?php echo Form::text('year', null , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')); ?>

		            </div>
		        </div>
		    	<div class="col-sm-6">
		    		<label><strong><?php echo e(__('Egilea(k)')); ?>:</strong></label>
		    	 	<?php echo e(Form::text('publicacionesAutores', '', [
				        'id'           =>'publicacionesAutores',
				        'placeholder'  =>__('Egilea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogPublicacionesAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'publicaciones',
				        'data-idUl'    =>'ulPublicacionesAutores',
				        'data-id'      => $publicacion->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulPublicacionesAutores" class="list-group">
			 			<?php $__currentLoopData = $publicacion->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachAutores<?php echo e($autor->id); ?>">
				 				<a data-id='<?php echo e($publicacion->id); ?>' data-idAutor='<?php echo e($autor->id); ?>' data-carpeta ='autores' data-tipo='publicaciones'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($autor->nombre); ?> <?php echo e($autor->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	<?php echo e(Form::hidden('tipo', $publicacion->tipo)); ?>

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
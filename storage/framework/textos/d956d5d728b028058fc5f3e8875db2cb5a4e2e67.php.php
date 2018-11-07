<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('postgradosEdit', $postgrado); ?>

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
		           	<?php if( $postgrado->tipo == 'master' ): ?>
						<h2><?php echo e(__('Masterretan parte-hartzea')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Doktoretza-programetan parte-hartzea')); ?></h2>
					<?php endif; ?>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('postgrados.index', ['tipo'  => $postgrado->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			<?php echo $__env->make('layouts.dialog', [
				'idDialog' => "dialogPostgradosAutores",
				'idForm'=>'formdialogPostgradosAutores',
				'tituloContenido' => __('Egile berria sortu') ,
			], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php echo Form::model($postgrado, ['method' => 'PUT','route' => ['postgrados.update', $postgrado->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Programa')); ?> :</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Ikastaroa')); ?>:</strong></label>
		                <?php echo Form::text('curso_eu', null, array('placeholder' => 'Ikastaroa','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
		        <div class="col-sm-6 ">
		           <div class="form-group">
		                <label><strong><?php echo e(__('Saila')); ?> (*):</strong></label>
		                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $postgrado->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Iraupena')); ?>(*):</strong></label>
		                <?php echo Form::text('duracion', null, array('placeholder' => '15 ECTS','class' => 'form-control ')); ?>

		            </div>
		        </div>
		    </div>
		    <div class="row" style="margin:1px;">
		       <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Tokia')); ?> (*):</strong></label>
		                <?php echo Form::text('lugar', 'Gipuzkoako Ingeniaritza Eskola', array('placeholder' => '15 ECTS','class' => 'form-control ')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Hasiera Data')); ?> (*):</strong></label>
		                <?php echo Form::text('fecha', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
		    	<div class="col-sm-6">
		    		<label><?php echo e(__('Irakaslea(k)')); ?> (*): <span class='autorInfo'></span></label>
		    	 	<?php echo e(Form::text('postgradosAutores', '', [
				        'id'           =>'postgradosAutores',
				        'placeholder'  =>__('Irakaslea bilatu'),
				        'class'        =>'form-control buscadorAutor inputAutores',
				        'data-idDialog'=>'dialogPostgradosAutores',
				        'data-carpeta' =>'autores',
				        'data-tipo'    =>'postgrados',
				        'data-idUl'    =>'ulPostgradosAutores',
				        'data-id'      => $postgrado->id
		    	 	]
		    	 	)); ?>

			 		<br><ul id="ulPostgradosAutores" class="list-group">
			 			<?php $__currentLoopData = $postgrado->autores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autor): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			 				<li class="list-group-item" id="detachAutores<?php echo e($autor->id); ?>">
				 				<a data-id='<?php echo e($postgrado->id); ?>' data-idAutor='<?php echo e($autor->id); ?>' data-carpeta ='autores' data-tipo='postgrados'  class='desenlazar'>
				 					<i class="fa fa-trash"></i>
				 				</a>
			 				<?php echo e($autor->nombre); ?> <?php echo e($autor->apellido); ?>

			 				</li>
			 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			 		</ul>
			 	</div>

			</div>
		        <div class="col-md-12 col-sm-12 col-md-12 text-center">
		        	<?php echo e(Form::hidden('tipo', $postgrado->tipo)); ?>

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
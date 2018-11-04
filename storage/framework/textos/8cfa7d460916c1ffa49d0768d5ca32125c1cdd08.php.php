<?php $__env->startSection('content'); ?>

   <?php echo Breadcrumbs::render('tesisDoctoralesEdit', $tesisDoctoral); ?>

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
		            <h2><?php echo e(__('Tesiak')); ?></h2>
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('tesisDoctorales.index', ['tipo'  => $tesisDoctoral->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

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
	<?php echo $__env->make('layouts.dialog', [
		'idDialog' => "dialogTesisDoctoralesDirector",
		'idForm'=>'formdialogTesisDoctoralesDirector',
		'tituloContenido' => __('Zuzendari berria sortu') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('layouts.dialog', [
		'idDialog' => "dialogTesisDoctoralesDoctorando",
		'idForm'=>'formdialogTesisDoctoralesDoctorando',
		'tituloContenido' => __('Doctorando berria sortu') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::model($tesisDoctoral, ['method' => 'PUT','route' => ['tesisDoctorales.update', $tesisDoctoral->id]]); ?>

		<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Izenburua / Titulo:</strong></label>
                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>
        <!--<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Titulo:</strong></label>
                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')); ?>

            </div>
        </div>-->
    </div>
	<div>
		<div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>Saila/ Departamento (*):</strong></label>
                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), $tesisDoctoral->departamento , ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

            </div>
        </div>
		<div class="col-sm-3">
            <?php echo e(Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('euskera', 1, $tesisDoctoral->euskera, ['class' => ''])); ?>

        </div>
        <div class="col-sm-3">
           <?php echo e(Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('internacional', 1, $tesisDoctoral->internacional, ['class' => ''])); ?>

        </div>
	</div>


	<div class='row'>
		<div style="margin:30px;">
			<?php if($tesisDoctoral->tipo=='tesisLeidas'): ?>
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong><?php echo e(__('Data')); ?> :</strong></label>
			                <?php echo Form::text('fechaLectura', $tesisDoctoral->fechaLectura , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-sm-6 "> </div>
		    <?php endif; ?>
		    <?php if($tesisDoctoral->tipo=='proximaLectura'): ?>
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong><?php echo e(__('Kurtsoa')); ?> :</strong></label>
			                <span><i>( <?php echo e($tesisDoctoral->curso); ?> - <?php echo e($tesisDoctoral->curso +1); ?> )</i></span>
			                <?php echo Form::text('curso', $tesisDoctoral->curso , array('placeholder' => __('Kurtsoa') ,'class' => 'date-year form-control')); ?>

			            </div>
			        </div>
			    </div><div class="col-sm-6 "> </div>
		    <?php endif; ?>
		</div>
	</div>


    <div>
    	<div class="col-sm-6">
    		<label><strong><?php echo e(__('Zuzendaria(k)')); ?> (*):</strong></label>
    	 	<?php echo e(Form::text('tesisDoctoralesDirector', '', [
		        'id'           =>'tesisDoctoralesDirector',
		        'placeholder'  =>__('Zuzendaria bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogTesisDoctoralesDirector',
		        'data-carpeta' =>'director',
		        'data-tipo'    =>'tesisDoctorales',
		        'data-idUl'    =>'ulTesisDoctoralesDirector',
		        'data-id'      => $tesisDoctoral->id
    	 	]
    	 	)); ?>

	 		<br><ul id="ulTesisDoctoralesDirector" class="list-group">
	 			<?php $__currentLoopData = $tesisDoctoral->directores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	 				<li class="list-group-item" id="detachDirector<?php echo e($director->id); ?>">
		 				<a data-id='<?php echo e($tesisDoctoral->id); ?>' data-idAutor='<?php echo e($director->id); ?>' data-carpeta ='director' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				<?php echo e($director->nombre); ?> <?php echo e($director->apellido); ?>

	 				</li>
	 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	 		</ul>
	 	</div>
	 	<div class="col-sm-6 ">
    		<label><strong><?php echo e(__('Ikerlaria(k)')); ?> (*):</strong></label>
    	 	<?php echo e(Form::text('tesisDoctoralesDoctorando', '', [
	         'id'           =>'tesisDoctoralesDoctorando ',
	         'placeholder'  =>__('Doktorandoa bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogTesisDoctoralesDoctorando',
	         'data-carpeta' =>'doctorando',
	         'data-tipo'    =>'tesisDoctorales',
	         'data-idUl'    =>'ulTesisDoctoralesDoctorando',
	         'data-id'      => $tesisDoctoral->id
	        ])); ?>

	 		<br><ul id="ulTesisDoctoralesDoctorando" class="list-group">
	 			<?php $__currentLoopData = $tesisDoctoral->doctorandos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctorando): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	 				<li class="list-group-item"  id="detachDoctorando<?php echo e($doctorando->id); ?>">
	 					<a data-id='<?php echo e($tesisDoctoral->id); ?>' data-idAutor='<?php echo e($doctorando->id); ?>' data-carpeta ='doctorando' data-tipo='tesisDoctorales'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					<?php echo e($doctorando->nombre); ?> <?php echo e($doctorando->apellido); ?>

	 				</li>
	 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	 		</ul>
	 	</div>
	</div>
	<div class="col-md-12 col-sm-12 col-md-12 text-center">
		<?php echo e(Form::hidden('tipo', $tesisDoctoral->tipo)); ?>

		<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
    </div>
	<?php echo Form::close(); ?>

</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
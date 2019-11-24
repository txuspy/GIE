<?php $__env->startSection('content'); ?><?php echo Breadcrumbs::render('grupoInvestigacionEdit', $grupoInvestigacion); ?>

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
		            <h2><?php echo e(__('Ikerkuntza taldea')); ?></h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('grupoInvestigacion.index')); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>



	<?php echo $__env->make('layouts.dialog', [
		'idDialog' => "dialogGrupoInvestigacionResponsable",
		'idForm'=>'formdialogGrupoInvestigacionResponsable',
		'tituloContenido' => __('Arduradun berria sortu') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('layouts.dialog', [
		'idDialog' => "dialogGrupoInvestigacionParticipante",
		'idForm'=>'formdialogGrupoInvestigacionParticipante',
		'tituloContenido' => __('Partaide berria sortu') ,
	], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::model($grupoInvestigacion, ['method' => 'PATCH','route' => ['grupoInvestigacion.update', $grupoInvestigacion->id]]); ?>

	<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Taldea (*)</strong></label>
                <?php echo Form::text('grupo_eu', null, array('placeholder' => 'Taldea','class' => 'form-control')); ?>

            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Grupo:</strong></label>
                <?php echo Form::text('grupo_es', null, array('placeholder' => 'Grupo','class' => 'form-control')); ?>

            </div>
        </div>

    </div>
	<div>
		 <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Ikerkuntza lerroak (*):</strong></label>
                <?php echo Form::textarea('lineasInv_eu', null, array('placeholder' => 'Ikerkuntza lerroak','class' => 'form-control summernote')); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Líneas de investigación :</strong></label>
                <?php echo Form::textarea('lineasInv_es', null, array('placeholder' => 'Líneas de investigación','class' => 'form-control summernote')); ?>

            </div>
        </div>
    </div>
	<div>
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Noiztik')); ?> (*)</strong></label>
                <?php echo Form::text('desde',  null , array('placeholder' => __('Noiztik') ,'class' => 'date-year form-control')); ?>

            </div>
        </div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
                <?php echo Form::text('hasta', null , array('placeholder' => __('Hutsik utzi gaur egun martxan badago') ,'class' => 'date-year form-control')); ?>

            </div>
        </div>
    </div>
    <div>
    	<div class="col-sm-6 ">
    		<label><strong><?php echo e(__('Arduraduna(k)')); ?> (*)</strong><span class='autorInfo'></span></label>
    	 	<?php echo e(Form::text('grupoInvestigacionResponsable', '', [
		        'id'           =>'grupoInvestigacionResponsable',
		        'placeholder'  =>__('Arduraduna bilatu'),
		        'class'        =>'form-control buscadorAutor inputAutores',
		        'data-idDialog'=>'dialogGrupoInvestigacionResponsable',
		        'data-carpeta' =>'responsable',
		        'data-tipo'    =>'grupoInvestigacion',
		        'data-idUl'    =>'ulGrupoInvestigacionResponsables',
		        'data-id'      => $grupoInvestigacion->id
    	 	]
    	 	)); ?>

	 		<br><ul id="ulGrupoInvestigacionResponsables" class="list-group">
	 			<?php $__currentLoopData = $grupoInvestigacion->responsables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $responsable): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	 				<li class="list-group-item" id="detachResponsable<?php echo e($responsable->id); ?>">
		 				<a data-id='<?php echo e($grupoInvestigacion->id); ?>' data-idAutor='<?php echo e($responsable->id); ?>' data-carpeta ='responsable' data-tipo='grupoInvestigacion'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 				<?php echo e($responsable->nombre); ?> <?php echo e($responsable->apellido); ?>

	 				</li>
	 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	 		</ul>
	 	</div>
	 	<div class="col-sm-6 ">
    		<label><strong><?php echo e(__('Partaidea(k)')); ?> (*)</strong><span class='autorInfo'></span></label>
    	 	<?php echo e(Form::text('grupoInvestigacionParticipante', '', [
	         'id'           =>'grupoInvestigacionParticipante ',
	         'placeholder'  =>__('Partaidea bilatu'),
	         'class'        =>'form-control buscadorAutor inputAutores' ,
	         'data-idDialog'=>'dialogGrupoInvestigacionParticipante',
	         'data-carpeta' =>'participante',
	         'data-tipo'    =>'grupoInvestigacion',
	         'data-idUl'    =>'ulGrupoInvestigacionParticipantes',
	         'data-id'      => $grupoInvestigacion->id
	        ])); ?>

	 		<br><ul id="ulGrupoInvestigacionParticipantes" class="list-group"  >
	 			<?php $__currentLoopData = $grupoInvestigacion->participantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participante): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	 				<li class="list-group-item" id="detachParticipante<?php echo e($participante->id); ?>">
	 					<a data-id='<?php echo e($grupoInvestigacion->id); ?>' data-idAutor='<?php echo e($participante->id); ?>' data-carpeta ='participante' data-tipo='grupoInvestigacion'  class='desenlazar'>
		 					<i class="fa fa-trash"></i>
		 				</a>
	 					<?php echo e($participante->nombre); ?> <?php echo e($participante->apellido); ?>

	 				</li>
	 			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	 		</ul>
	 	</div>
	</div>
    <div>
    	<div class="col-md-12 col-sm-12 col-md-12 text-center">
        <div>
			<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Bidali')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
        </div>
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
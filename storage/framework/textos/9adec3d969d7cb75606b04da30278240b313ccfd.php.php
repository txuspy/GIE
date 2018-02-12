<?php $__env->startSection('content'); ?>
<div class="container">
   <?php echo Breadcrumbs::render('usuariosEdit', $user); ?>

   <?php echo $__env->make('dialog.upload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit New User</h2>
                <?php if(count($imagenes) > 0): ?>
                    <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div id="<?php echo e($imagen->id_imagenes); ?>">
                            <a class='delete_field' tipoArchivo='imagen' tipo='usuarios' attrId='<?php echo e($user->id); ?>' idFile='<?php echo e($imagen->id_imagenes); ?>' nomFile='<?php echo e($imagen->nom_imagenes); ?>' tamanoFile='<?php echo e($imagen->tamano_imagenes); ?>' title="Delete">
                                <img src="/images/usuarios/<?php echo e($imagen->nom_imagenes); ?>" class="img-circle" width="35px" alt="<?php echo e($imagen->title_imagenes); ?>">
                                 <i class="fa fa-trash-o" role="button" aria-hidden="true" title="<?php echo e(__('Delete img: ')); ?><?php echo e($imagen->id_imagenes); ?>"></i>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <?php if( count($adjuntos) > 0  ): ?>
                <h2>Adjuntos</h2>
                    <?php $__currentLoopData = $adjuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div id="<?php echo e($adjunto->id_adjunto); ?>">
                            <a src="/down/usuarios/<?php echo e($adjunto->nom_adjunto); ?>" target="_blank"  role="button">
                                <?php echo e($adjunto->title_adjunto); ?>

                            </a>(
                            <a class='delete_field' tipoArchivo='archivo' tipo='usuarios' attrId='<?php echo e($user->id); ?>' idFile='<?php echo e($adjunto->id_adjunto); ?>' nomFile='<?php echo e($adjunto->nom_adjunto); ?>'  title="Delete" tamanoFile='0' >
                               <i class="fa fa-trash-o" role="button" aria-hidden="true" title="<?php echo e(__('Delete file: ')); ?><?php echo e($adjunto->id_adjunto); ?>"></i>
                            </a> )
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>

	        </div>

	        <div class="pull-right">
	            <button class="btn btn-danger upload" tipoArchivo='imagen' tipo='usuarios' attrId='<?php echo e($user->id); ?>'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo e(__('Upload Image')); ?></button>
	            <button class="btn btn-warning upload" tipoArchivo='archivo' tipo='usuarios' attrId='<?php echo e($user->id); ?>'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo e(__('Upload File')); ?></button>
	            <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> Back</a>
	        </div>
	    </div>
	</div>
    <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload OK.')); ?></strong>
	</div>
	<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload ERROR.')); ?></strong>
	</div>
	<?php if(count($errors) > 0): ?>
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<li><?php echo e($error); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</ul>
		</div>
	<?php endif; ?>
	<?php echo Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]); ?>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <?php echo Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')); ?>

            </div>
        </div>
	    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong><?php echo e(__('Estado')); ?>:</strong>
                <?php echo Form::radio('estado', 1, true, ['class' => 'field']); ?>

            </div>
        </div>

	    <div class="col-xs-12">
            <div class="form-group" >
                <strong class="col-xs-3" ><?php echo e(__('Idioma')); ?>:</strong><!-- margin left mal -->
                <div class="col-xs-9">
                    <lavel class="col-xs-3"><?php echo e(__('español')); ?> <?php echo e(Form::radio("lng", "es")); ?></lavel>
                    <lavel class="col-xs-3"><?php echo e(__('francés')); ?> <?php echo e(Form::radio("lng", "fr")); ?></lavel>
                    <lavel class="col-xs-3"><?php echo e(__('inglés')); ?> <?php echo e(Form::radio("lng", "en")); ?></lavel>
                </div>
            </div>
        </div>
    	<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User id:</strong>
                <?php echo Form::text('user_id', null, array('placeholder' => 'user_id','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <?php echo Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <?php echo Form::password('password', array('placeholder' => 'Password','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <?php echo Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <?php echo Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')); ?>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</div>
	<?php echo Form::close(); ?>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
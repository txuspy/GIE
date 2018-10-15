<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(\Auth::user()->hasRole('admin')): ?>
        <?php echo Breadcrumbs::render('usuariosEdit', $user); ?>

    <?php else: ?>
       <?php echo Breadcrumbs::render('usuariosNOAdminVer', $user); ?>

    <?php endif; ?>
   <?php echo $__env->make('dialog.upload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(session()->has('firstTime')): ?>
        <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert">
    		<strong> <?php echo e(__('Lehenbiziko aldia da sartzen zarela, zure datuak ondo bete, eta pasahitza aldatu.')); ?></strong>
    	</div>
    <?php endif; ?>
    <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload OK.')); ?></strong>
	</div>
	<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
		<strong> <?php echo e(__('Upload ERROR.')); ?></strong>
	</div>
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
	<?php echo Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]); ?>

	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Izena')); ?>:</strong>
                <?php echo Form::text('name', null, array('placeholder' => __('Izena'),'class' => 'form-control')); ?>

            </div>
        </div>
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Abizenak')); ?>:</strong>
                <?php echo Form::text('lname', null, array('placeholder' => __('Abizenak') ,'class' => 'form-control')); ?>

            </div>
        </div>
        
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Posta elektronikoa')); ?>:</strong>
                <?php echo Form::text('email', null, array('placeholder' => __('Posta elektronikoa'),'class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Pasahitza')); ?> :</strong>
                <?php if(session()->has('firstTime')): ?>
                     <div class="alert alert-danger">
                        <strong><?php echo e(__('Pasahitza')); ?></strong>
                    </div>
                <?php endif; ?>
                <?php if(session()->has('firstTime')): ?>
                    <?php echo Form::input('password', 'password', __('Pasahitza'), ['class' => 'form-control']); ?>

                <?php else: ?>
                    <?php echo Form::password('password', array('placeholder' =>  __('Pasahitza'),'class' => 'form-control')); ?>

                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong><?php echo e(__('Pasahitza Konfirmatu')); ?>:</strong>
                <?php if(session()->has('firstTime')): ?>
                    <div class="alert alert-danger">
                        <strong><?php echo e(__('Pasahitza Konfirmatu')); ?></strong>
                    </div>
                <?php endif; ?>
                <?php echo Form::password('confirm-password', array('placeholder' => __('Pasahitza Konfirmatu'),'class' => 'form-control')); ?>

            </div>

        </div>
         <div class="col-xs-12">
            <div class="form-group" >
                <strong class="col-xs-3" ><?php echo e(__('Hizkuntza')); ?>:</strong><!-- margin left mal -->
                <div class="col-xs-9">
                    <lavel class="col-xs-3"><?php echo e(__('Castellano')); ?> <?php echo e(Form::radio("lng", "es")); ?></lavel>
                    <lavel class="col-xs-3"><?php echo e(__('Euskara')); ?> <?php echo e(Form::radio("lng", "eu")); ?></lavel>
                </div>
            </div>
        </div>
        @role('admin')

            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong><?php echo e(__('Errola')); ?>:</strong>
                    <?php echo Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')); ?>

                </div>
            </div>
        @endrole
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
				<button type="submit" class="btn btn-primary"><?php echo e(__('Bidali')); ?></button>
        </div>
	</div>
	<?php echo Form::close(); ?>

	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
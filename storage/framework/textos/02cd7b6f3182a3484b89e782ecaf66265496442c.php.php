<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Create New User</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="<?php echo e(route('users.index')); ?>"> Back</a>
	        </div>
	    </div>
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
	<?php echo Form::open(array('route' => 'users.store','method'=>'POST', 'class'=>'form' )); ?>

	<div class="row">
		<div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Name:</strong></label>
                <?php echo Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Apellido :</strong></label>
                <?php echo Form::text('lname', null, array('placeholder' => 'Apellido','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Estado :</strong></label>
                <?php echo Form::select('estado', ['1' => 'Activo', '0' => 'Baja' ],1 , ['class' => 'form-control chosen-type']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 ">

            <div class="form-group">
                <label><strong>User Id:</strong></label>
                <?php echo Form::text('user_id', null, array('placeholder' => 'user_id','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Email:</strong></label>
                <?php echo Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Password:</strong></label>
                <?php echo Form::password('password', array('placeholder' => 'Password','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-4 ">
            <div class="form-group">
                <label><strong>Confirm Password:</strong></label>
                <?php echo Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')); ?>

            </div>
        </div>
        <div class="col-xs-8">
            <div class="form-group  input-text-wrapper">
                <label><strong>Role:</strong></label>
                <?php echo Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')); ?>

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
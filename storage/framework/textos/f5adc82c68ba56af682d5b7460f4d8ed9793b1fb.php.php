<?php $__env->startSection('content'); ?>
<div class="portlet-body">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <!--<div class="form-group<?php echo e($errors->has('ldap') ? '  has-error' : ''); ?>">
                            <label for="ldap" class="col-md-4 control-label"><?php echo e(__('WebUntis')); ?></label>
                            <div class="col-md-6">
                                <input id="ldap" type="text" class="form-control" name="ldap" value="<?php echo e(old('ldap')); ?>" required autofocus>
                                <?php if($errors->has('ldap')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('ldap')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>-->
                        <div class="form-group<?php echo e($errors->has('email') ? '  has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label"><?php echo e(__('Posta elektronikoa')); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('password') ? '  has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   <?php echo e(__("Entrar")); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">
                                    <?php echo e(__("He olvidado mi contraseña")); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
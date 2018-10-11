<?php $__env->startSection('content'); ?>

    <div class="container-fluid col-md-12  margin-tb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><?php echo e(__('Ongi etorria Gipuzkoako Ingenieritza Eskolako memoria sortzeko aplikaziora.')); ?></strong></div>
                <div class="panel-body">
                     <?php if($passwordCambiar): ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <?php echo e(__('Aurretik zehaztutako pasahitza aldatu beharra dago.')); ?>

                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <?php echo e(__('Deberías cambiar la contraseña predefinida.')); ?>

                        </div>


                    <?php endif; ?>
                    <p>
                    </p>
                    <div>
                        <div class="col-md-6">
                            <p><stong><?php echo e(__('Erabiltzailearen honespenak')); ?>:</stong> </p>
                            <p><small><?php echo e(__('Pasahitza aldatzeko, hizkuntza ...')); ?></small></p>
                            <?php //phpinfo(); ?>
                            <video controls height="170" width="auto">

                                <source src="/videos/pasahitza.mp4" type="video/mp4" />
                            </video>
                        </div>
                        <div class="col-md-6">
                            <p><stong><?php echo e(__('Ezagutza basikoa')); ?>:</stong> </p>
                            <p><small><?php echo e(__('Erregistro bat sortu')); ?></small></p>
                             <video controls height="170" width="auto">
                            <source src="/videos/basicos.mp4" type="video/mp4" />
                        </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
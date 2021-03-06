<?php $__env->startSection('content'); ?>

    <div class="container-fluid col-md-12  margin-tb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-heading"><strong><?php echo e(__('Ongi etorria Gipuzkoako Ingeniaritza Eskolako oroitidazkia sortzeko aplikaziora.')); ?></strong></div>
                <div>
                        <img src="/images/Gipuzkoako_Ingeniaritza_Eskol.png" width="100%"></img>
                    </div>
                <div class="panel-body">
                    <?php echo $__env->make('layouts.mensages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                        <div class="col-md-4">
                            <p><stong><?php echo e(__('Jarraibideak')); ?>:</stong> </p>
                            <p><small><?php echo e(__('Power point gida')); ?></small></p>

                            <a href="/doc/Jarraibideak_Instrucciones.pdf">
                                <img src="/images/laguntza.png" height="170">
                            </a>
                        </div>
                        <div class="col-md-4">
                            <p><stong><?php echo e(__('Erabiltzailearen onespenak')); ?>:</stong> </p>
                            <p><small><?php echo e(__('Pasahitza aldatzeko, hizkuntza ...')); ?></small></p>

                            <video controls height="170" width="auto">

                                <source src="/videos/pasahitza.mp4" type="video/mp4" />
                            </video>
                        </div>
                        <div class="col-md-4">
                            <p><stong><?php echo e(__('Oinarrizko ezagutza')); ?>:</stong> </p>
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
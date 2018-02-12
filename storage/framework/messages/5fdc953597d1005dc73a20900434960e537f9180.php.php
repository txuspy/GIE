<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(__('Intranet FOREST PIONEER SL')); ?></div>

                <div class="panel-body">
              
                    <?php echo e(__('FOREST PIONEER SL')); ?><br>
                    <?php echo e(__('Estas dentro de la intranet')); ?><br>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
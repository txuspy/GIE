<?php $__env->startSection('content'); ?>
    <div class="container-fluid col-md-12  margin-tb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><?php echo e(__('Alertas personalizadas')); ?></strong></div>

                <div class="panel-body">
                    <?php echo e(__('Listado de los expedientes por tipo y todo eso')); ?>

                    <?php //phpinfo(); ?>
                    Ikusi berhar dugu ze empresetan gauden

                    <!--<p>-->
                    <!--    <img src="/images/brand/HorizontalLOGO.gif" height="40px"/>-->
                    <!--</p>-->

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
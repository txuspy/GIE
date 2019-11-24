<?php $__env->startSection('title'); ?>
    <?php echo e(__('Descargas')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <?php echo e(__('Descargando archivo...')); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dialog.dialog', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('dialog.upload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong> <?php echo e(__('Upload OK.')); ?></strong>
</div>
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
    <strong> <?php echo e(__('Upload ERROR.')); ?></strong>
</div>

<div class='row'>
    <div class="pull-right">
        <button class="btn btn-warning upload" tipoArchivo='archivo' tipo='<?php echo e($tipo); ?>'
                attrId='<?php echo e($attrId); ?>'><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                <?php echo e(__('Upload File')); ?></button>
            <a class="btn btn-info" href="<?php echo e(url()->previous()); ?>"> Back</a>
    </div>
    <div>
         <?php if( count($adjuntos) > 0  ): ?>
            <h2>Adjuntos</h2>
            <?php $__currentLoopData = $adjuntos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div id="<?php echo e($adjunto->id_adjunto); ?>" class='col-md-2'>
                    <a src="/down/<?php echo e($carpeta); ?>/<?php echo e($adjunto->nom_adjunto); ?>" target="_blank"  role="button">
                        <?php echo e($adjunto->title_adjunto); ?>

                    </a>(
                    <a class='delete_field' tipoArchivo='archivo' tipo='<?php echo e($tipo); ?>' attrId='<?php echo e($attrId }' idFile='{{ $adjunto->id_adjunto); ?>' nomFile='<?php echo e($adjunto->nom_adjunto); ?>'  title="Delete" tamanoFile='0' >
                        <i class="fa fa-trash-o" role="button" aria-hidden="true" title="<?php echo e(__('Delete file: ')); ?><?php echo e($adjunto->id_adjunto); ?>"></i> <?php echo e(__('Delete')); ?>

                    </a> )
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
    </div>
</div>
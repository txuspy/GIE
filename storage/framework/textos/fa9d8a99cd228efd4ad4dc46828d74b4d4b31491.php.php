<?php echo $__env->make('dialog.upload', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong> <?php echo e(__('Upload OK.')); ?></strong>
</div>
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
    <strong> <?php echo e(__('Upload ERROR.')); ?></strong>
</div>

<div class='row'>
    <div class="pull-right">
        <button class="btn btn-warning upload" tipoArchivo='imagen' tipo='<?php echo e($tipo); ?>'
                attrId='<?php echo e($attrId); ?>'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?php echo e(__('Upload Image')); ?>

        </button>
        <a class="btn btn-info" href="<?php echo e(url()->previous()); ?>"> Back</a>
    </div>
    <div>
        <?php if(count($imagenes) > 0): ?>
        <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <div id="<?php echo e($imagen->id_imagenes); ?>" class='col-md-2'>
            <img src="/images/<?php echo e($carpeta); ?>/<?php echo e($imagen->nom_imagenes); ?>" alt="<?php echo e($imagen->title_imagenes); ?>">
            <a class='btn btn-danger delete_field' tipoArchivo='imagen' tipo='<?php echo e($tipo); ?>' attrId='<?php echo e($attrId); ?>'
               idFile='<?php echo e($imagen->id_imagenes); ?>' nomFile='<?php echo e($imagen->nom_imagenes); ?>'
               tamanoFile='<?php echo e($imagen->tamano_imagenes); ?>' title="Delete">

                <i class="fa fa-trash-o" role="button" aria-hidden="true"
                   title="<?php echo e(__('Delete img: ')); ?><?php echo e($imagen->id_imagenes); ?>"></i> <?php echo e(__('Delete')); ?>

            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <?php endif; ?>
    </div>
</div>
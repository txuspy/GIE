<span class= "<?php echo e($attr['claseSpan']); ?> mostraOcultarInput" data-nomDiv = "<?php echo e($nombreCampo); ?><?php echo e($valorId); ?>"  id = "<?php echo e($nombreCampo); ?><?php echo e($valorId.'_t'); ?>" >
    <?php if( isset( $attr['esTelefono']) ): ?>
        <?php if(!empty($valorNombre)): ?>
            <a class="btn btn-warning btn-sm" href="tel:<?php echo e($valorNombre); ?>">
              <i class="fa fa-phone" aria-hidden="true"></i> <?php echo e($valorNombre); ?>

            </a>
        <?php endif; ?>
    <?php elseif(isset( $attr['esEmail']) ): ?>
        <?php if(!empty($valorNombre)): ?>
            <a class="btn btn-warning btn-sm" href='mailto:<?php echo e($valorNombre); ?>'><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo e($valorNombre); ?></a>
         <?php endif; ?>
    <?php else: ?>
        <?php echo e($valorNombre); ?>

    <?php endif; ?>
</span>

<?php if($clasePermiso): ?>
    <?php echo \Form::text(
            $nombreCampo.$valorId,
            $valorNombre,
            [
                'id'               => $nombreCampo.$valorId,
                'placeholder'      => isset($attr['placeholder'])?$attr['placeholder']: '',
                'class'            => 'mostraOcultarInput guardarEnBDInput form-control input-sm '.( empty($valorNombre) ? (isset($attr['siVacio']) ? $attr['siVacio'] : ''):$attr['claseInput']) ,
                'data-nomDiv'      => $nombreCampo.$valorId.'_t',
                'data-nombreTabla' => $nombreTabla,
                'data-nombreId'    => $nombreId,
                'data-nombreCampo' => $nombreCampo,
                'data-valorId'     => $valorId
            ]
        );; ?>

<?php endif; ?>
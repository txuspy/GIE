<span class= "<?php echo e($attr['claseSpan']); ?> mostraOcultarInput" data-nomDiv = "<?php echo e($nombreCampo); ?><?php echo e($valorId); ?>"  id = "<?php echo e($nombreCampo); ?><?php echo e($valorId.'_t'); ?>" ><?php echo e($valorNombre); ?></span>
<?php if($clasePermiso): ?>
    <?php echo \Form::textarea(
            $nombreCampo.$valorId,
            $valorNombre,
            [
                'size'             => isset($size)?$size: '30x5',
                'id'               => $nombreCampo.$valorId,
                'placeholder'      => isset($attr['placeholder'])?$attr['placeholder']: '',
                'class'            => 'mostraOcultarInput guardarEnBDInput form-control input-sm '.( !empty($valorNombre)?$attr['claseInput']: ''),
                'data-nomDiv'      => $nombreCampo.$valorId.'_t',
                'data-nombreTabla' => $nombreTabla,
                'data-nombreId'    => $nombreId,
                'data-nombreCampo' => $nombreCampo,
                'data-valorId'     => $valorId
            ]
        );; ?>

<?php endif; ?>


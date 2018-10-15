

<?php echo e(trans('adminlte_lang::message.passwordclickreset')); ?> <a href="<?php echo e(url('password/reset/'.$token)); ?>"><?php echo e(url('password/reset/'.$token)); ?></a>
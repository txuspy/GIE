<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>
<?php if(!empty($success)): ?>
    <div class="alert alert-success">
        <p><?php echo $success; ?></p>
    </div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
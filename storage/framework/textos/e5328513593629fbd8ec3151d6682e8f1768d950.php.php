<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    
    <!--<link href="<?php echo e(url(App\Lib\Functions::parseLang().'/css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url(App\Lib\Functions::parseLang().'/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!--<link href="<?php echo e(url('/css/font-awesome.min.css')); ?>" rel="stylesheet">-->
       <link type="text/css" media="all" rel="stylesheet" href="<?php echo e(asset('/css/app.css')); ?>">
    <link type="text/css" media="all" rel="stylesheet" href="<?php echo e(asset('/css/font-awesome.min.css')); ?>">
  
 
</head>
<body>
     <div id="app">
       <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
         @permission('permission-list')
   
  
        <div class="container">

            <div class="row">
                <div class="col-md-12">                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Nombre')); ?></th>
                                        <th><?php echo e(__('Dysplay Name')); ?></th>
                                        <th><?php echo e(__('Descripción')); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="datos">
                                   
                                    <?php $__currentLoopData = $permisos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiso): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <tr id='linea<?php echo e($permiso->id); ?>'>
                                       
                                        <td scope="row"> <input type="checkbox" name="id_permiso[<?php echo e($loop->index +1); ?>]" id="id_permiso[<?php echo e($loop->index +1); ?>]" value="<?php echo e($permiso->id); ?>" /> <?php echo e($permiso->name); ?></td>
                                        <td><?php echo e($permiso->display_name); ?></td>
                                        <td><?php echo e($permiso->description); ?></td>
                                       <td><a href="/permisos/<?php echo e($permiso->id); ?>/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <tr><td><?php echo e(__('Total:' )); ?> <?php echo e($permisos->total()); ?></td><td colspan='2' class='text-center'><?php echo e($permisos->links()); ?></td><td><?php echo e(__('Pagina actual:' )); ?> <?php echo e($permisos->currentPage()); ?></td></tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpermission
    </div>
    <!-- Scripts -->
     <script src="<?php echo e(url('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js')); ?>"></script>
     <script src="<?php echo e(url(App\Lib\Functions::parseLang().'/js/app.js')); ?>"></script>
</body>
</html>
<html>
<head>
    <link type="text/css" media="all" rel="stylesheet" href="<?php echo e(asset('/css/app.css')); ?>">
    <script type="text/javascript">var centreGot = false;</script>
    <?php echo $map['js']; ?>

</head>
<body>
    <div class="row" style="margin: 5px; padding:5px;">
        <div class="col-md-12 margin-tb ">
            <div class="panel panel-default " style=" padding:5px">
        <p> <?php echo e(__('Nº clientes :')); ?><?php echo e($mensaje['total']); ?><br><?php echo e(__('Con puntero:')); ?><b> <?php echo e($mensaje['conPuntero']); ?> </b><br> <?php echo e(__('Sin puntero :')); ?> <b><?php echo e($mensaje['sinPuntero']); ?> </b></p>
    </div>
    <?php echo $map['html']; ?>

</body>
</html>
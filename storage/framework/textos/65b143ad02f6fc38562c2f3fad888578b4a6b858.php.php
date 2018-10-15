<!DOCTYPE html>
<html class="aui ltr" dir="ltr" lang="es-ES">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'GIE')); ?></title>

    <link href="https://www.ehu.eus/ehu-theme/images/apple-touch-icon-precomposed.png"
          rel="apple-touch-icon-precomposed">

    <?php echo Html::style( asset('css/app.css')); ?>

    <?php echo Html::style( asset('css/aui.css')); ?>

    <?php echo Html::style( asset('css/main.body.css')); ?>


    <?php echo Html::style( asset('css/comunes.css')); ?>

    <?php echo Html::style( asset('css/jquery-ui.css')); ?>

    <?php echo Html::style( asset('css/font-awesome.min.css')); ?>

    <?php echo Html::style( asset('css/responsive-tabs.css')); ?>

    <?php echo Html::style( asset('css/responsive-tabs-style.css')); ?>

    <?php echo Html::style( asset('css/jquery.dataTables.min.css')); ?>

    <?php echo Html::style( asset('css/responsive.dataTables.min.css')); ?>

    <?php echo Html::style( asset('css/bootstrap-datepicker3.css')); ?>

    <?php echo Html::style( asset('css/bootstrap-datepicker.standalone.min.css')); ?>



    <?php echo Html::script('js/app.js'); ?>

    <?php echo Html::script('js/jquery-ui.js'); ?>

    <?php echo Html::script('js/jquery.dataTables.min.js'); ?>

    <?php echo Html::script('js/dataTables.responsive.min.js'); ?>

    <?php echo Html::script('js/bootstrap-filestyle.min.js'); ?>

    <?php echo Html::script('js/jquery.responsiveTabs.min.js'); ?>

    <?php echo Html::script('js/bootstrap-datepicker.js'); ?>

    <?php echo Html::script('js/bootstrap-datepicker.es.min.js'); ?>

    <?php echo Html::script('js/bootstrap-datepicker.eu.min.js'); ?>

    <?php echo Html::script('js/filesImgScript.js'); ?>

    <?php echo Html::script('js/funcionesComunes.js'); ?>

    <?php echo Html::script('js/autocomplementar.js'); ?>

    <?php echo Html::script('js/jqueryComunes.js'); ?>



</head>


  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container-fluid">
        <?php $__env->startSection('header'); ?>
            <?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldSection(); ?>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
           <?php $__env->startSection('sidebar'); ?>
                <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldSection(); ?>
        </div>
          <div class="col-sm-9">
          <h1><?php echo e(config('app.name', 'GIE')); ?></h1>
          <?php echo $__env->yieldContent('content'); ?>
          </div>
      </div>
    </div>


    <?php echo $__env->yieldContent('scripts'); ?>
    <script>
      $('.datepicker').datepicker({
          language: "<?php echo e(\Session::get('locale')); ?>"
      });
    /*  $(function() {
          // Set idle time
          $( document ).idleTimer( 72000 );
      });

      $(function() {
          $( document ).on( "idle.idleTimer", function(event, elem, obj){
              window.location.href = "example.com/login"
          });
      });*/
    </script>
  </body>



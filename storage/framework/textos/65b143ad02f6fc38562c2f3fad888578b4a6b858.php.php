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

    <?php echo Html::script('js/filesImgScript.js'); ?>

    <?php echo Html::script('js/funcionesComunes.js'); ?>

    <?php echo Html::script('js/autocomplementar.js'); ?>

    <?php echo Html::script('js/jqueryComunes.js'); ?>


</head>
<body class="public-page">

<div id="wrapper">
    <header id="head">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <nav id="menu-languages" class="span4 navbar" aria-label="Menú de idiomas" role="navigation">
                        <div class="navbar-inner">
                            <div>
                                <ul aria-label="Menú de idiomas" role="menubar" class="nav nav-left pull-left">
                                    <?php $__currentLoopData = config('app.supported-locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(\Session::get('locale')==strtolower(ucfirst($locale)) ): ?>
                                            <li role="presentation" class="selected">
                                        <?php else: ?>
                                            <li role="presentation">
                                        <?php endif; ?>
                                            <a href='/<?php echo e($locale); ?>/home'>
                                                <?php if(\Session::get('locale')==strtolower(ucfirst($locale)) ): ?>
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                <?php endif; ?>
                                                <?php echo e(ucfirst($locale)); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <nav id="menu-campus" class="span8 navbar" aria-label="Menú de campus" role="navigation">
                        <div class="navbar-inner">
                            <div>
                                <ul aria-label="Menú de campus" role="menubar" class="nav nav-right pull-right">
                                    <?php if(Auth::guest()): ?>
                                        <li class="sign-in btn btn-info" role="presentation"><a href="<?php echo e(url('/login')); ?>"><?php echo e(__('Iniciar sesión')); ?> <i class="fa fa-lock" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                                    <?php else: ?>
                                    <li>
                                        <a><?php echo e(\Carbon\Carbon::now('Europe/Madrid')->toTimeString()); ?> </a>
                                    </li>
                                        <li class="sign-in btn btn-info" role="presentation">
                                            <a href="<?php echo e(url(App\Lib\Functions::parseLang().'/users/'.Auth::user()->id.'/edit')); ?>"  data-toggle="dropdown" role="button" aria-expanded="false">
                                            <?php echo e(Auth::user()->name); ?> <i class="fa fa-cog" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href=""
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo e(__('Logout')); ?>

                                            </a>

                                            <form id="logout-form" action="<?php echo e(url(App\Lib\Functions::parseLang().'/logout')); ?>" method="POST" style="display: none;">
                                                 <?php echo e(csrf_field()); ?>

                                            </form>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header-brand">
            <div class="container">
                <div class="row">
                    <h1 class="brand span8">
                        <a href="https://www.ehu.eus/es">
                            <img class="logo" src="https://www.ehu.eus/ehu-theme/images/custom/logo.png"
                                 alt="Universidad del País Vasco">
                        </a>
                    </h1>
                </div>
            </div>
        </div>
        <div class="main-menu">
            <div class="container">
                <div class="row">
                    <nav id="menu-main" class="span12 navbar" aria-label="Menú principal" role="navigation">
                        <div class="navbar-inner">
                            <div class="collapse nav-collapse">



                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bottom-header">
            <div class="container">
                <div class="row">


                </div>
            </div>
        </div>
    </header>
    <section id="content" aria-label="Contenido principal">
        <div class="container-fluid">
            <div class=" row">
                <nav class="col-sm-3 col-md-3 d-none d-sm-block bg-light sidebar">
                    <?php $__env->startSection('sidebar'); ?>
                        <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->yieldSection(); ?>
                </nav>
                <main role="main" class="col-sm-9 ml-sm-auto col-md-9 pt-3">
                    <header id="info-title">
                        <h1><?php echo e(config('app.name', 'GIE')); ?></h1>
                    </header>
                     <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="footer-menu">
            <div class="container">
                <ul class="inline menu-footer pull-left">
                    <li><a href="/es/irisgarritasuna">Accesibilidad</a></li>
                    <li><a href="/es/lege-oharra">Información legal</a></li>
                    <li><a href="contact">Contacto</a></li>
                    <li><a href="sitemap">Mapa</a></li>
                    <li><a href="/es/laguntza">Ayuda</a></li>
                </ul>
                <p class="pull-right">UPV/EHU</p>
            </div>
        </div>
    </footer>
</div>

</body>
</html>

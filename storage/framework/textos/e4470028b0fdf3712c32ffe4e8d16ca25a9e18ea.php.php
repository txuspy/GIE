<div class="top-menu">


                <nav id="menu-languages" class="span4 navbar" aria-label="Menú de idiomas" role="navigation">

                        <?php if(!Auth::guest()): ?>

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

                        <?php endif; ?>

                </nav>
                <nav id="menu-campus" class="span12 navbar" aria-label="Menú de campus" role="navigation">
                    <ul aria-label="Menú de campus" role="menubar" class="nav nav-right pull-right">
                        <?php if(Auth::guest()): ?>
                            <li class="sign-in btn btn-info" role="presentation"><a href="<?php echo e(url('/login')); ?>"><?php echo e(__('Sesioa hasi')); ?> <i class="fa fa-lock" aria-hidden="true"></i></a></li>
                        <?php else: ?>

                        <li>
                            <a><?php echo e(\Carbon\Carbon::now('Europe/Madrid')->toTimeString()); ?> </a>
                        </li>

                            <li>
                                <a href="<?php echo e(url(App\Lib\Functions::parseLang().'/users/'.Auth::user()->id.'/edit')); ?>"   title="<?php echo e(__('Erabiltzailaren detaileak')); ?>" >
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
                </nav>


    </div>
    <!--<div class="header-brand">
            <div class="row">
                <h1 class="brand span12">
                    <a href="https://www.ehu.eus/es">
                        <img class="logo" src="https://www.ehu.eus/ehu-theme/images/custom/logo.png"
                             alt="<?php echo e(__('Euskal Herriko unibertsitatea')); ?>">
                    </a>
                </h1>
                <h1><?php echo e(config('app.name', 'GIE')); ?></h1>
            </div>
    </div>-->

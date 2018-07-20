
<nav id="side-menu" aria-label="Menú específico" role="navigation" >
     <ul class="class-toggle-active level-1" role="menubar" >
          <li class="side-nav-item">
            <a href="/home">
                <span><?php echo e(config('app.name', 'GIE')); ?></span>
            </a>
            <ul class="sub-nav level-2">
                <li>
                    <a href="https://www.ehu.eus/es">
                        <img class="logo" src="/images/UPV_Excelencia_bilingue_positivo_alta.png"
                         alt="<?php echo e(__('Euskal Herriko unibertsitatea')); ?>" width="100%">
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <br>
    <ul class="class-toggle-active level-1" role="menubar">
        @role('owner')
            <li class="side-nav-item">
                <a href="/home">
                    <span><?php echo e(__('Administratzailea')); ?></span>
                </a>
                <ul class="sub-nav level-2">
                    @permission('user-list')
                    <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/users')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Erabiltzaileak')); ?></a></li>@endpermission
                    @role('owner')
                        @permission('role-list')<li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/roles')); ?>"><i class="fa fa-user-times" aria-hidden="true"></i> <?php echo e(__('Errolak')); ?></a></li> @endpermission
                        @permission('permission-list')<li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/permisos')); ?>"><i class="fa fa-lock" aria-hidden="true"></i> <?php echo e(__('Baimenak')); ?></a></li>         @endpermission
                    @endrole
                    <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/autor')); ?>"><i class="fa fa-users" aria-hidden="true"></i> <?php echo e(__('Partaideak')); ?></a></li>
                </ul>
            </li>
           <br>
        @endrole
        @role('admin')
            <li class="side-nav-item">
                <a href="/home">
                    <span><?php echo e(__('Txostenak')); ?></span>
                </a>
                <ul class="sub-nav level-2">
                    @permission('user-list')
                    <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/word')); ?>"><i class="fa fa-file-word-o" aria-hidden="true"></i> <?php echo e(__('Word')); ?></a></li>
                    @endpermission

                </ul>
            </li>
           <br>
        @endrole
        <li  class="side-nav-item has-sub-nav class-toggle-active">
            <a href="">
                <span> <?php echo e(__('IKERKUNTZA JARDUERAK')); ?></span>
            </a>
            <ul class="sub-nav level-2">
                @permission('customer-list')@endpermission
                <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/postgrados/show/master')); ?>"><i class="fa fa-id-card" aria-hidden="true"></i> <?php echo e(__('Graduondoko programa')); ?></a>
                       <ul>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/postgrados/show/master')); ?>"><i class="fa fa-id-card-o" aria-hidden="true"></i> <?php echo e(__('Master-programa')); ?></a></li>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/postgrados/show/doctorando')); ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?php echo e(__('Doktoretza-programa')); ?></a></li>
                        </ul>
                  </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/recibir')); ?>"><i class="fa fa-book" aria-hidden="true"></i> <?php echo e(__('IIPko Formazioa')); ?></a>
                       <ul>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/recibir')); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> <?php echo e(__('Hartutako formazioa')); ?></a></li>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/dar')); ?>"><i class="fa fa-address-book-o" aria-hidden="true"></i> <?php echo e(__('Emandako formazioa')); ?></a></li>
                        </ul>
                  </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PAS/recibir')); ?>"><i class="fa fa-book" aria-hidden="true"></i> <?php echo e(__('AZPko Formazioa')); ?></a>
                       <ul>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PAS/recibir')); ?>"><i class="fa fa-address-book" aria-hidden="true"></i> <?php echo e(__('Hartutako formazioa')); ?></a></li>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/formaciones/show/PAS/dar')); ?>"><i class="fa fa-address-book-o" aria-hidden="true"></i> <?php echo e(__('Emandako formazioa')); ?></a></li>
                        </ul>
                  </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera')); ?>"><i class="fa fa-refresh" aria-hidden="true"></i> <?php echo e(__('Elkartrukeko programak')); ?></a>
                      <ul>

                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/azp')); ?>"><i class="fa fa-share" aria-hidden="true"></i> <?php echo e(__('IIP / AZPren mugikortasuna')); ?></a></li>
                        </ul>
                  </li>
                <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/visitas/show')); ?>">
                    <i class="fa fa-car" aria-hidden="true"></i> <?php echo e(__('Bisitak')); ?></a></li>
                <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/grupoInvestigacion')); ?>">
                    <i class="fa fa-users" aria-hidden="true"></i> <?php echo e(__('Ikerkuntza taldeak')); ?></a></li>
               <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/tesisLeidas')); ?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?php echo e(__('Tesiak')); ?></a>
                    
                </li>
               <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/proyectos/show/europa')); ?>">
                    <i class="fa fa-flask" aria-hidden="true"></i> <?php echo e(__('Ikerkuntza Proiektuak')); ?></a>
                   <ul>
                        <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/proyectos/show/europa')); ?>"><i class="fa fa-eur" aria-hidden="true"></i> <?php echo e(__('Europar Batasuneko Programa Markoa')); ?></a></li>
                        <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/proyectos/show/erakundeak')); ?>"><i class="fa fa-building-o" aria-hidden="true"></i> <?php echo e(__('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak')); ?></a></li>
                        <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/proyectos/show/empresa')); ?>"><i class="fa fa-industry" aria-hidden="true"></i> <?php echo e(__('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak')); ?></a></li>
                    </ul>
                </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/congresos')); ?>"><i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo e(__('Kongresu Zientifikoetan parte-hartzea')); ?></a></li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/publicaciones/show/libros')); ?>"><i class="fa fa-archive" aria-hidden="true"></i> <?php echo e(__('Argitalpenak')); ?></a>
                       <ul>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/publicaciones/show/libros')); ?>"><i class="fa fa-book" aria-hidden="true"></i> <?php echo e(__('Liburuak eta Monografiak')); ?></a></li>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/publicaciones/show/articulos')); ?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <?php echo e(__('Artikuloak')); ?></a></li>
                        </ul>
                  </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera')); ?>"><i class="fa fa-refresh" aria-hidden="true"></i> <?php echo e(__('Elkartrukeko programak')); ?></a>
                      <ul>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera')); ?>"><i class="fa fa-share" aria-hidden="true"></i> <?php echo e(__('Egonaldi zientifikoak beste Unibertsitateetan')); ?></a></li>
                            <li class="level-3"><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/enCasa')); ?>"><i class="fa fa-reply" aria-hidden="true"></i> <?php echo e(__('Etorritako ikerlariak')); ?></a></li>

                        </ul>
                  </li>
                  <li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/equipamientoNuevo')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Hornikuntza Zientifikoa eskuratzea')); ?></a></li>
            </ul>
        </li>
    </ul>
</nav>
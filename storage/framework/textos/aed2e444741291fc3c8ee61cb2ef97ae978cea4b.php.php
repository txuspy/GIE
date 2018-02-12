<nav id="side-menu" aria-label="Menú específico" role="navigation" >
    <h2>
        <a href="/es/home">
            <span><?php echo e(config('app.name', 'GIE')); ?></span>
        </a>
    </h2>
    <ul class="class-toggle-active level-1" role="menubar">
        <li id="navParent65" class="side-nav-item">
            <a href="/">
                <span><?php echo e(__('Usuarios')); ?></span>
            </a>
            <span class="children-marker class-toggle icon-chevron-up"
                  data-target-node="#navParent65" tabindex="0">
				 	<span class="hide-accessible">Mostrar/ocultar subpáginas</span>
				</span>
            <ul class="sub-nav level-2">
                @permission('user-list')<li><a href="<?php echo e(route('users.index')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Usuarios')); ?></a></li>@endpermission
                @permission('role-list')<li><a href="<?php echo e(route('roles.index')); ?>"><i class="fa fa-user-md" aria-hidden="true"></i> <?php echo e(__('Roles')); ?></a></li> @endpermission
                @permission('permission-list')<li><a href="<?php echo e(route('permisos.ver')); ?>"><i class="fa fa-user-times" aria-hidden="true"></i> <?php echo e(__('Permisos')); ?></a></li> @endpermission


            </ul>
        </li>
        <li id="navParent60" class="side-nav-item has-sub-nav class-toggle-active">
            <a href="/es/ikasketak">
                <span> <?php echo e(__('Administracion')); ?></span>
            </a>
            <span class="children-marker class-toggle icon-chevron-up"
                  data-target-node="#navParent60" tabindex="0">
				 	<span class="hide-accessible">Mostrar/ocultar subpáginas</span>
				</span>
            <ul class="sub-nav level-2">
                @permission('customer-list')<li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/customer/tipo/1')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Clientes')); ?></a></li>@endpermission
                @permission('customer-list')<li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/customer/tipo/2')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Proveedores')); ?></a></li>@endpermission
                @permission('customer-list')<li><a href="<?php echo e(url(App\Lib\Functions::parseLang().'/contactos')); ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo e(__('Contactos')); ?></a></li>@endpermission

            </ul>
        </li>


    </ul>
</nav>
<nav id="side-menu" aria-label="Menú específico" role="navigation" >
    <ul class="class-toggle-active level-1" role="menubar">
        @role('admin')
            <li class="side-nav-item">
                <a href="/home">
                    <span>{{ __('Administratzailea') }}</span>
                </a>
                <ul class="sub-nav level-2">
                    @permission('user-list')
                    <li><a href="{{ url(App\Lib\Functions::parseLang().'/users')  }}"><i class="fa fa-user" aria-hidden="true"></i> {{ __('Erabiltzaileak') }}</a></li>@endpermission
                    @role('owner')
                        @permission('role-list')<li><a href="{{ url(App\Lib\Functions::parseLang().'/roles')  }}"><i class="fa fa-user-times" aria-hidden="true"></i> {{ __('Errolak') }}</a></li> @endpermission
                        @permission('permission-list')<li><a href="{{ url(App\Lib\Functions::parseLang().'/permisos')  }}"><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Baimenak') }}</a></li>         @endpermission
                    @endrole
                    <li><a href="{{ url(App\Lib\Functions::parseLang().'/autor')  }}"><i class="fa fa-users" aria-hidden="true"></i> {{ __('Partaideak') }}</a></li>
                </ul>
            </li>
           <br>
        @endrole
        <li  class="side-nav-item has-sub-nav class-toggle-active">
            <a href="">
                <span> {{ __('IKERKUNTZA JARDUERAK') }}</span>
            </a>
            <ul class="sub-nav level-2">
                @permission('customer-list')@endpermission
                <li><a href="{{ url(App\Lib\Functions::parseLang().'/grupoInvestigacion')  }}">
                    <i class="fa fa-users" aria-hidden="true"></i> {{ __('Ikerkuntza taldeak') }}</a></li>
               <li><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/proximaLectura') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ __('Tesiak') }}</a>
                    <ul>
                        <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/proximaLectura') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> {{__('Uneko Tesiak')}}</a></li>
                        <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/tesisLeidas') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{__('Burutu diren Tesiak')}}</a></li>
                    </ul>
                </li>
               <li><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/europa') }}">
                    <i class="fa fa-flask" aria-hidden="true"></i> {{ __('Ikerkuntza Proiektuak') }}</a>
                   <ul>
                        <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/europa') }}"><i class="fa fa-eur" aria-hidden="true"></i> {{__('Europar Batasuneko Programa Markoa')}}</a></li>
                        <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/erakundeak') }}"><i class="fa fa-building-o" aria-hidden="true"></i> {{__('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak')}}</a></li>
                        <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/empresa') }}"><i class="fa fa-industry" aria-hidden="true"></i> {{__('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak')}}</a></li>
                    </ul>
                </li>
                  <li><a href="{{ url(App\Lib\Functions::parseLang().'/congresos')   }}"><i class="fa fa-briefcase" aria-hidden="true"></i> {{ __('Kongresu Zientifikoetan parte-hartzea') }}</a></li>
                  <li><a href="{{ url(App\Lib\Functions::parseLang().'/publicaciones/show/libros') }}"><i class="fa fa-archive" aria-hidden="true"></i> {{ __('Argitalpenak') }}</a>
                       <ul>
                            <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/publicaciones/show/libros') }}"><i class="fa fa-book" aria-hidden="true"></i> {{__('Liburuak eta Monografiak')}}</a></li>
                            <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/publicaciones/show/articulos') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> {{__('Artikuloak')}}</a></li>
                        </ul>
                  </li>
                  <li><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera') }}"><i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Elkartrukeko programak') }}</a>
                      <ul>
                            <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('Egonaldi zientifikoak beste Unibertsitateetan')}}</a></li>
                            <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/enCasa') }}"><i class="fa fa-reply" aria-hidden="true"></i> {{__('Etorritako ikerlariak')}}</a></li>
                        </ul>
                  </li>
                  <li><a href="{{ url(App\Lib\Functions::parseLang().'/equipamientoNuevo')   }}"><i class="fa fa-user" aria-hidden="true"></i> {{ __('Hornikuntza Zientifikoa eskuratzea') }}</a></li>
            </ul>
        </li>
    </ul>
</nav>
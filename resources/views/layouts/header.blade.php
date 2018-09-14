<div class="top-menu">


                <nav id="menu-languages" class="span4 navbar" aria-label="Menú de idiomas" role="navigation">

                        @if (!Auth::guest())

                                <ul aria-label="Menú de idiomas" role="menubar" class="nav nav-left pull-left">

                                    @foreach(  config('app.supported-locales') as $locale )
                                        @if(\Session::get('locale')==strtolower(ucfirst($locale)) )
                                            <li role="presentation" class="selected">
                                        @else
                                            <li role="presentation">
                                        @endif
                                            <a href='/{{ $locale }}/home'>
                                                @if(\Session::get('locale')==strtolower(ucfirst($locale)) )
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                @endif
                                                {{ ucfirst($locale) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                        @endif

                </nav>
                <nav id="menu-campus" class="navbar" aria-label="Menú de campus" role="navigation">
                    <ul aria-label="Menú de campus" role="menubar" class="nav nav-right pull-right">
                        @if (Auth::guest())
                            <li class="sign-in btn btn-info" role="presentation"><a href="{{ url('/login') }}">{{ __('Sesioa hasi')}} <i class="fa fa-lock" aria-hidden="true"></i></a></li>
                        @else

                        <li>
                            <a>{{ \Carbon\Carbon::now('Europe/Madrid')->toTimeString() }} </a>
                        </li>

                            <li>
                                <a href="{{ url(App\Lib\Functions::parseLang().'/users/'.Auth::user()->id.'/edit') }}"   title="{{ __('Erabiltzailaren detaileak')}}" >
                                    {{ Auth::user()->name }} <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href=""
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}
                                </a>
                                <form id="logout-form" action="{{ url(App\Lib\Functions::parseLang().'/logout') }}" method="POST" style="display: none;">
                                     {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </nav>


    </div>
    <!--<div class="header-brand">
            <div class="row">
                <h1 class="brand span12">
                    <a href="https://www.ehu.eus/es">
                        <img class="logo" src="https://www.ehu.eus/ehu-theme/images/custom/logo.png"
                             alt="{{ __('Euskal Herriko unibertsitatea')}}">
                    </a>
                </h1>
                <h1>{{ config('app.name', 'GIE') }}</h1>
            </div>
    </div>-->

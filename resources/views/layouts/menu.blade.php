
<nav id="side-menu" aria-label="Menú específico" role="navigation" >
	<ul class="class-toggle-active level-1" role="menubar" >
		<li class="side-nav-item">
			<a href="/home">
				<span>{{ config('app.name', 'GIE') }}</span>
			</a>
			<ul class="sub-nav level-2">
				<li>
					<a href="https://www.ehu.eus/es">
						<img class="logo" src="/images/Escuela-Ingenieria_Gipuzkoa.png"
						alt="{{ __('Euskal Herriko unibertsitatea')}}" width="100%">
					</a>
				</li>
			</ul>
		</li>
	</ul>
	<br>
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
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/infoTeknikoa')  }}"><i class="fa fa-server" aria-hidden="true"></i> {{ __('Informazio teknikoa') }}</a></li>
			</ul>
		</li>
		<br>
		@endrole
	
		<li class="side-nav-item">
			<a href="/home">
				<span>{{ __('Txostenak') }}</span>
			</a>
			<ul class="sub-nav level-2">
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/word')  }}"><i class="fa fa-file-word-o" aria-hidden="true"></i> {{ __('Word') }}</a></li>
			</ul>
		</li>
		<br>

		<li  class="side-nav-item has-sub-nav class-toggle-active">

			<a href="">
				<span> {{ __('IRAKASKUNTZA-JARDUERA') }}</span>
			</a>
			<ul class="sub-nav level-2">
				@role('admin')
				
					<li><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzakAurretik/show/aurretik') }}">
						<i class="fa fa-user-o" aria-hidden="true"></i> {{ __('Unibertsitate aurreko ikasleei bideratutako ekintzak') }}</a>
						{{--<ul>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzakAurretik/show/aurretik') }}"><i class="fa fa-user-o" aria-hidden="true"></i> {{__('Unibertsitate aurreko ikasleei bideratutako ekintzak')}}</a></li>
						</ul>--}}
					</li>
					<li><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzak/show/laguntza') }}">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ __('Eskolako ikasleei bideratutako ekintzak') }}</a>
						<ul>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzak/show/laguntza') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> {{__('Bidelaguntza')}}</a></li>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzak/show/formakuntzaOsagarriak') }}"><i class="fa fa-address-card" aria-hidden="true"></i> {{__('Formakuntza Osagarriak')}}</a></li>
						</ul>
					</li>
					@endrole
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera') }}"><i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Elkartrukeko programak') }}</a>
					<ul>
						<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/internacional') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('Elkartrukeko programak / mugikortasuna')}}</a></li>
						{{--<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/azp') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('IRI / AZPren mugikortasuna')}}</a></li>--}}
					</ul>
				</li>
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/visitas/show')  }}">
					<i class="fa fa-car" aria-hidden="true"></i> {{ __('Instalazio bisitak') }}</a>
				</li>
				
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/recibir') }}"><i class="fa fa-book" aria-hidden="true"></i> {{ __('IIPko Formazioa Jarduerak') }}</a>
					<ul>
						<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/recibir') }}"><i class="fa fa-address-book" aria-hidden="true"></i> {{__('Jasotako formakuntza')}}</a></li>
						<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/formaciones/show/PDI/dar') }}"><i class="fa fa-address-book-o" aria-hidden="true"></i> {{ __('Emandako formazioa')}}</a></li>
					</ul>
				</li>
				
			<!--	<li><a href="{{ url(App\Lib\Functions::parseLang().'/postgrados/show/master') }}"><i class="fa fa-id-card" aria-hidden="true"></i> {{ __('Graduondoko programa') }}</a>
					<ul>
						<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/postgrados/show/master') }}"><i class="fa fa-id-card-o" aria-hidden="true"></i> {{__('Master-programa')}}</a></li>
						   
						   <li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/postgrados/show/doctorando') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{__('Doktoretza-programa')}}</a>
						   </li>
						
					</ul>
				</li>
			-->
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera') }}"><i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Elkartrukeko programak') }}</a>
					<ul>
					<!--	<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/internacional') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('Elkartrukeko programak / mugikortasuna')}}</a></li>-->
						<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/azp') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('IRI / AZPren mugikortasuna')}}</a></li>
					</ul>
				</li>
				
			</ul>
		</li>
		<li  class="side-nav-item has-sub-nav class-toggle-active">
			<a href="">
				<span>  {{  mb_strtoupper(  __('AZPko Formazioa') ) }}</span>
			</a>
			<ul class="sub-nav level-2">
				<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/formaciones/show/PAS/recibir') }}"><i class="fa fa-address-book" aria-hidden="true"></i> {{__('Jasotako formakuntza')}}</a></li>
				<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/formaciones/show/PAS/dar') }}"><i class="fa fa-address-book-o" aria-hidden="true"></i> {{__('Emandako formazioa')}}</a></li>
			</ul>
		</li>
		<li  class="side-nav-item has-sub-nav class-toggle-active">
			<a href="">
				<span> {{ __('IKERKUNTZA-JARDUERA') }}</span>
			</a>

			
			<ul class="sub-nav level-2">
			   
				@permission('customer-list')@endpermission
				<li><a href="{{ url(App\Lib\Functions::parseLang().'/grupoInvestigacion')  }}">
					<i class="fa fa-users" aria-hidden="true"></i> {{ __('Ikerkuntza taldeak') }}</a></li>
					<li><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/tesisLeidas') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{ __('Tesiak') }}</a>
						{{--
						<ul>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/proximaLectura') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> {{__('Uneko Tesiak')}}</a></li>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/tesisLeidas') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{__('Burutu diren Tesiak')}}</a></li>
						</ul>
						--}}
					</li>
					<li><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/europa') }}">
						<i class="fa fa-flask" aria-hidden="true"></i> {{ __('Ikerkuntza Proiektuak') }}</a>
						<ul>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/europa') }}"><i class="fa fa-eur" aria-hidden="true"></i> {{__('Europar Batasuneko Programa Markoa')}}</a></li>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/erakundeak') }}"><i class="fa fa-building-o" aria-hidden="true"></i> {{__('Erakundeek diruz lagundutako ikerkuntza Proiektuak')}}</a></li>
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/proyectos/show/empresa') }}"><i class="fa fa-industry" aria-hidden="true"></i> {{__('Enpresek diruz lagundutako ikerkuntza Proiektuak')}}</a></li>
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
							<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/fuera') }}"><i class="fa fa-share" aria-hidden="true"></i> {{__('Egonaldiak / Beste Unibertsitateetan bisita')}}</a></li>
						</ul>
					</li>
					<li><a href="{{ url(App\Lib\Functions::parseLang().'/equipamientoNuevo')   }}"><i class="fa fa-user" aria-hidden="true"></i> {{ __('Hornikuntza Zientifikoa eskuratzea') }}</a></li>
					@role('admin')
						<li><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzakGizartea/show/gizartea') }}">
							<i class="fa fa-users" aria-hidden="true"></i> {{ __('Gizarte-erantzukizuneko ekintzak') }}</a>
							{{--<ul>
								<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/ekintzakGizartea/show/gizartea') }}"><i class="fa fa-eur" aria-hidden="true"></i> {{__('Gizarte-erantzukizuneko ekintzak')}}</a></li>
							</ul>--}}
						</li>
						<li><a href="{{ url(App\Lib\Functions::parseLang().'/divulgacion/show/hedakuntza') }}">
							<i class="fa fa-television" aria-hidden="true"></i> {{ __('Eskolaren hedakuntza') }}</a>
							<ul>
								<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/divulgacion/show/hedakuntza') }}"><i class="fa fa-television" aria-hidden="true"></i> {{__('Eskolaren hedakuntza')}}</a></li>
								<li class="level-3"><a href="{{ url(App\Lib\Functions::parseLang().'/divulgacion/show/prensa') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> {{__('Prentsa')}}</a></li>
							</ul>
						</li>
					@endrole
				</ul>
				
			</li>
		</ul>
	</nav>
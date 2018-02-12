<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/home'));
});

// Home > Usuarios
Breadcrumbs::register('usuarios', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Usuarios', url('/users'));
});
Breadcrumbs::register('usuariosVer', function($breadcrumbs, $usuario)
{
    $breadcrumbs->parent('usuarios');
    $breadcrumbs->push($usuario->name, url('users/'.$usuario->id));
});
Breadcrumbs::register('usuariosEdit', function($breadcrumbs, $usuario)
{
    $breadcrumbs->parent('usuarios');
    $breadcrumbs->push($usuario->name, url('users/'.$usuario->id.'/edit'));
});
// Home > Role
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Roles', url('/roles'));
});
Breadcrumbs::register('rolesVer', function($breadcrumbs, $role)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push($role->name, url('roles/'.$role->id));
});
Breadcrumbs::register('rolesEdit', function($breadcrumbs, $role)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push($role->name, url('roles/'.$role->id.'/edit'));
});
// Home > Permisos
Breadcrumbs::register('permisos', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Permisos', route('permisos.ver'));
});
Breadcrumbs::register('permisosEditar', function($breadcrumbs, $permiso)
{
    $breadcrumbs->parent('permisos');
    $breadcrumbs->push($permiso->name, route('permisos.edit', $permiso->id));
});

// Home > Autores
Breadcrumbs::register('autores', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Autores', url('/autor'));
});
Breadcrumbs::register('autoresEdit', function($breadcrumbs, $autor)
{
    $breadcrumbs->parent('autores');
    $breadcrumbs->push($autor->nombre, url('autor/'.$autor->id.'/edit'));
});
// Home > Grupo investigacion
Breadcrumbs::register('grupoInvestigacion', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('Ikerkuntza taldea'), url('/grupoInvestigacion'));
});
Breadcrumbs::register('grupoInvestigacionEdit', function($breadcrumbs, $grupoInvestigacion)
{
    $breadcrumbs->parent('grupoInvestigacion');
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($grupoInvestigacion->grupo_eu, url('grupoInvestigacion/'.$grupoInvestigacion->id.'/edit'));
    }else{
        $breadcrumbs->push($grupoInvestigacion->grupo_es, url('grupoInvestigacion/'.$grupoInvestigacion->id.'/edit'));
    }
});
//Tesis doctorales
Breadcrumbs::register('tesisDoctorales', function($breadcrumbs, $tipo)
{
    $breadcrumbs->parent('home');
    if( $tipo == 'proximaLectura' ){
        $breadcrumbs->push( __('Uneko Tesiak'), url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/'.$tipo));
    }else{
        $breadcrumbs->push( __('Burutu diren Tesiak'), url(App\Lib\Functions::parseLang().'/tesisDoctorales/show/'.$tipo));
    }
});
Breadcrumbs::register('tesisDoctoralesEdit', function($breadcrumbs, $tesis)
{
    $breadcrumbs->parent('tesisDoctorales', $tesis->tipo);
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($tesis->titulo_eu , url(App\Lib\Functions::parseLang().'tesisDoctorales/'.$tesis->id.'/edit'));
    }else{
        $breadcrumbs->push($tesis->titulo_es , url(App\Lib\Functions::parseLang().'tesisDoctorales/'.$tesis->id.'/edit'));
    }
});
//Proyectos
Breadcrumbs::register('proyectos', function($breadcrumbs, $tipo)
{
    $breadcrumbs->parent('home');
    if( $tipo == 'europa' ){
        $breadcrumbs->push( __('Europar Batasuneko Programa Markoa'), url(App\Lib\Functions::parseLang().'/proyectos/show/'.$tipo));
    }else if($tipo == 'erakundeak'){
        $breadcrumbs->push( __('Erakundeek diru-laguntza emandako Ikerkuntza Proiektuak'), url(App\Lib\Functions::parseLang().'/proyectos/show/'.$tipo));
    }else{
        $breadcrumbs->push( __('Enpresek diru-laguntza emandako Ikerkuntza Proiektuak'), url(App\Lib\Functions::parseLang().'/proyectos/show/'.$tipo));
    }
});
Breadcrumbs::register('proyectosEdit', function($breadcrumbs, $proyecto)
{
    $breadcrumbs->parent('tesisDoctorales', $proyecto->tipo);
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($proyecto->proyecto_eu , url(App\Lib\Functions::parseLang().'proyectos/'.$proyecto->id.'/edit'));
    }else{
        $breadcrumbs->push($proyecto->proyecto_es , url(App\Lib\Functions::parseLang().'proyectos/'.$proyecto->id.'/edit'));
    }
});
// Home > Congresos
Breadcrumbs::register('congresos', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push( __('Kongresu zientifikoentan parte-hartzea'), url('/congresos'));
});
Breadcrumbs::register('congresosEdit', function($breadcrumbs, $congresos)
{
    $breadcrumbs->parent('congresos');
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($congresos->congreso_eu, url('congresos/'.$congresos->id.'/edit'));
    }else{
        $breadcrumbs->push($congresos->congreso_es, url('congresos/'.$congresos->id.'/edit'));
    }
});
// Home > Equipamiento Nuevo
Breadcrumbs::register('equipamientoNuevo', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push( __('Hornikuntza Zientifikoa eskuratzea'), url('/equipamientoNuevo'));
});
Breadcrumbs::register('equipamientoNuevoEdit', function($breadcrumbs, $equipamientoNuevo)
{
    $breadcrumbs->parent('equipamientoNuevo');
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($equipamientoNuevo->equipo_eu, url('equipamientoNuevo/'.$equipamientoNuevo->id.'/edit'));
    }else{
        $breadcrumbs->push($equipamientoNuevo->equipo_es, url('equipamientoNuevo/'.$equipamientoNuevo->id.'/edit'));
    }
});
//Publicaciones
Breadcrumbs::register('publicaciones', function($breadcrumbs, $tipo)
{
    $breadcrumbs->parent('home');
    if( $tipo == 'libros' ){
        $breadcrumbs->push( __('Liburuak eta monografiak'), url(App\Lib\Functions::parseLang().'/publicaciones/show/'.$tipo));
    }else{
        $breadcrumbs->push( __('Artikuloak'), url(App\Lib\Functions::parseLang().'/publicaciones/show/'.$tipo));
    }
});
Breadcrumbs::register('publicacionesEdit', function($breadcrumbs, $publicacion)
{
    $breadcrumbs->parent('publicaciones', $publicacion->tipo);
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($publicacion->titulo_eu , url(App\Lib\Functions::parseLang().'publicaciones/'.$publicacion->id.'/edit'));
    }else{
        $breadcrumbs->push($publicacion->titulo_es , url(App\Lib\Functions::parseLang().'publicaciones/'.$publicacion->id.'/edit'));
    }
});
//Programa de intercambio
Breadcrumbs::register('programasDeIntercambio', function($breadcrumbs, $tipo)
{
    $breadcrumbs->parent('home');
    if( $tipo == 'enCasa' ){
        $breadcrumbs->push( __('Egonaldi zientifikoak beste Unibertsitateetan'), url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/'.$tipo));
    }else{
        $breadcrumbs->push( __('Etorritako ikerlariak'), url(App\Lib\Functions::parseLang().'/programasDeIntercambio/show/'.$tipo));
    }
});
Breadcrumbs::register('programasDeIntercambioEdit', function($breadcrumbs, $programaDeIntercambio)
{
    $breadcrumbs->parent('programasDeIntercambio', $programaDeIntercambio->tipo);
    if( \Session::get('locale') == 'eu' ){
        $breadcrumbs->push($programaDeIntercambio->actividad_eu , url(App\Lib\Functions::parseLang().'programasDeIntercambio/'.$programaDeIntercambio->id.'/edit'));
    }else{
        $breadcrumbs->push($programaDeIntercambio->actividad_es , url(App\Lib\Functions::parseLang().'programasDeIntercambio/'.$programaDeIntercambio->id.'/edit'));
    }
});
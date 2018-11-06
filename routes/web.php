<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\Welcome as WelcomeEmail;
use App\User;

Route::get('/', function () {
	\Session::forget('locale');
    return view('welcome');
    // return view('prueba');
});
Route::get('/gie', 'HomeController@gie' );
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::auth();
Route::group(['middleware' => ['auth']], function() {
	Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
	//Route::post('accion/ajaxInput', ['as' => 'ajax', 'uses' => 'ClientesController@ajaxInput']);

	// ARCHIVOS E IMAGENES
	Route::get('file-upload','ImageController@imageUpload');
	Route::post('file-upload','ArchivosController@uploadFile');
	Route::post('file-delete/{id}','ArchivosController@deleteFile');

	Route::get('autor/autocompletar','AutorController@autoresAjax');
	Route::resource('users','UserController');
	Route::resource('autor','AutorController');
	Route::post('autor/insertAjax','AutorController@storeAjax');

	Route::get('/word', ['as' => 'word', 'uses' => 'WordController@index']);
	Route::post('/word', ['as' => 'word.post', 'uses' => 'WordController@create']);


	Route::get('grupoInvestigacion/envioEmail', 'GrupoInvestigacionController@email');
	Route::get('grupoInvestigacion/autocompletar/{nombre}', 'GrupoInvestigacionController@grupoInvestigacionAjax');
	Route::get('grupoInvestigacion/word', 'GrupoInvestigacionController@word');
	Route::get('grupoInvestigacion/showAll', ['as' => 'grupoInvestigacion.indexAll', 'uses' => 'GrupoInvestigacionController@indexAll'] );
	Route::resource('grupoInvestigacion','GrupoInvestigacionController');
	Route::get('grupoInvestigacion/{id}/responsable/{id_autor}','GrupoInvestigacionController@enlazarResponsable');
	Route::post('grupoInvestigacion/search', ['as' => 'grupoInvestigacion.search', 'uses' => 'GrupoInvestigacionController@search']);
	Route::get('grupoInvestigacion/{id}/participante/{id_autor}','GrupoInvestigacionController@enlazarParticipante');
	Route::get('grupoInvestigacion/detach/{id}/responsable/{id_autor}','GrupoInvestigacionController@detachResponsable');
	Route::get('grupoInvestigacion/detach/{id}/participante/{id_autor}', 'GrupoInvestigacionController@detachParticipante');


	Route::get('congresos/autocompletar/{nombre}', 'CongresosController@congresosAjax');
	Route::get('congresos/showAll', ['as' => 'congresos.indexAll', 'uses' => 'CongresosController@indexAll'] );
	Route::post('congresos/search', ['as' => 'congresos.search', 'uses' => 'CongresosController@search'] );
	Route::resource('congresos','CongresosController');
	Route::get('congresos/{id}/profesor/{id_autor}','CongresosController@enlazarProfesor');
	Route::get('congresos/detach/{id}/profesor/{id_autor}','CongresosController@detachProfesor');

	Route::get('equipamientoNuevo/autocompletar/{nombre}', 'EquipamientoNuevoController@equipamientoNuevoAjax');
	Route::get('equipamientoNuevo/showAll', ['as' => 'equipamientoNuevo.indexAll', 'uses' => 'EquipamientoNuevoController@indexAll'] );
	Route::post('equipamientoNuevo/search',  ['as' => 'equipamientoNuevo.search', 'uses' => 'EquipamientoNuevoController@search']  );
	Route::resource('equipamientoNuevo','EquipamientoNuevoController');



	Route::get('tesisDoctorales/autocompletar/{nombre}', 'TesisDoctoralesController@tesisDoctoralesAjax');
	Route::get('tesisDoctorales/show/{tipo}', ['as' => 'tesisDoctorales.index', 'uses' => 'TesisDoctoralesController@index'] );
	Route::get('tesisDoctorales/showAll/{tipo}', ['as' => 'tesisDoctorales.indexAll', 'uses' => 'TesisDoctoralesController@indexAll'] );
	Route::get('tesisDoctorales/create/{tipo}', ['as' => 'tesisDoctorales.create', 'uses' => 'TesisDoctoralesController@create']  );
	Route::get('tesisDoctorales/{id}/edit', ['as' => 'tesisDoctorales.edit', 'uses' => 'TesisDoctoralesController@edit']  );

	Route::post('tesisDoctorales',  ['as' => 'tesisDoctorales.store', 'uses' => 'TesisDoctoralesController@store']  );
	Route::post('tesisDoctorales/search',  ['as' => 'tesisDoctorales.search', 'uses' => 'TesisDoctoralesController@search']  );
	Route::put('tesisDoctorales/{id}',  ['as' => 'tesisDoctorales.update', 'uses' => 'TesisDoctoralesController@update']  );
	Route::delete('tesisDoctorales/{id}/{tipo}', ['as' => 'tesisDoctorales.destroy', 'uses' => 'TesisDoctoralesController@destroy'] );
	Route::get('tesisDoctorales/{id}/director/{id_autor}','TesisDoctoralesController@enlazarDirector');
	Route::get('tesisDoctorales/{id}/doctorando/{id_autor}','TesisDoctoralesController@enlazarDoctorando');
	Route::get('tesisDoctorales/detach/{id}/director/{id_autor}','TesisDoctoralesController@detachDirector');
	Route::get('tesisDoctorales/detach/{id}/doctorando/{id_autor}', 'TesisDoctoralesController@detachDoctorando');


	Route::get('proyectos/autocompletar/{nombre}/{tipo}', 'ProyectosController@proyectosAjax');
	Route::get('proyectos/show/{tipo}', ['as' => 'proyectos.index', 'uses' => 'ProyectosController@index'] );
	Route::get('proyectos/showAll/{tipo}', ['as' => 'proyectos.indexAll', 'uses' => 'ProyectosController@indexAll'] );
	Route::get('proyectos/create/{tipo}', ['as' => 'proyectos.create', 'uses' => 'ProyectosController@create']  );
	Route::get('proyectos/{id}/edit', ['as' => 'proyectos.edit', 'uses' => 'ProyectosController@edit']  );
	Route::put('proyectos/{id}',  ['as' => 'proyectos.update', 'uses' => 'ProyectosController@update']  );
	Route::post('proyectos/',  ['as' => 'proyectos.store', 'uses' => 'ProyectosController@store']  );
	Route::post('proyectos/search',  ['as' => 'proyectos.search', 'uses' => 'ProyectosController@search']  );
	Route::delete('proyectos/{id}/{tipo}', ['as' => 'proyectos.destroy', 'uses' => 'ProyectosController@destroy'] );
	Route::get('proyectos/{id}/director/{id_autor}','ProyectosController@enlazarDirector');
	Route::get('proyectos/{id}/doctorando/{id_autor}','ProyectosController@enlazarInvestigador');
	Route::get('proyectos/detach/{id}/director/{id_autor}','ProyectosController@detachDirector');
	Route::get('proyectos/detach/{id}/doctorando/{id_autor}', 'ProyectosController@detachInvestigador');


	Route::get('publicaciones/autocompletar/{nombre}/{tipo}', 'PublicacionesController@publicacionesAjax');
	Route::get('publicaciones/showAll/{tipo}', ['as' => 'publicaciones.indexAll', 'uses' => 'PublicacionesController@indexAll'] );
	Route::get('publicaciones/show/{tipo}', ['as' => 'publicaciones.index', 'uses' => 'PublicacionesController@index'] );
	Route::get('publicaciones/create/{tipo}', ['as' => 'publicaciones.create', 'uses' => 'PublicacionesController@create']  );
	Route::get('publicaciones/{id}/edit', ['as' => 'publicaciones.edit', 'uses' => 'PublicacionesController@edit']  );
	Route::put('publicaciones/{id}',  ['as' => 'publicaciones.update', 'uses' => 'PublicacionesController@update']  );
	Route::post('publicaciones/',  ['as' => 'publicaciones.store', 'uses' => 'PublicacionesController@store']  );
	Route::post('publicaciones/search',  ['as' => 'publicaciones.search', 'uses' => 'PublicacionesController@search']  );
	Route::delete('publicaciones/{id}/{tipo}', ['as' => 'publicaciones.destroy', 'uses' => 'PublicacionesController@destroy'] );
	Route::get('publicaciones/{id}/autores/{id_autor}','PublicacionesController@enlazarAutores');
	Route::get('publicaciones/detach/{id}/autores/{id_autor}','PublicacionesController@detachAutores');

	Route::get('aldizkariak/autocompletar', 'PublicacionesController@aldizkariakAjax');


	Route::get('visitas/autocompletar/{nombre}', 'VisitasController@visitasAjax');
	Route::get('visitas/showAll', ['as' => 'visitas.indexAll', 'uses' => 'VisitasController@indexAll'] );
	Route::get('visitas/show', ['as' => 'visitas.index', 'uses' => 'VisitasController@index'] );
	Route::get('visitas/create', ['as' => 'visitas.create', 'uses' => 'VisitasController@create']  );
	Route::get('visitas/{id}/edit', ['as' => 'visitas.edit', 'uses' => 'VisitasController@edit']  );
	Route::put('visitas/{id}',  ['as' => 'visitas.update', 'uses' => 'VisitasController@update']  );
	Route::post('visitas/',  ['as' => 'visitas.store', 'uses' => 'VisitasController@store']  );
	Route::post('visitas/search',  ['as' => 'visitas.search', 'uses' => 'VisitasController@search']  );
	Route::delete('visitas/{id}', ['as' => 'visitas.destroy', 'uses' => 'VisitasController@destroy'] );
	Route::get('visitas/{id}/autores/{id_autor}','VisitasController@enlazarAutores');
	Route::get('visitas/detach/{id}/autores/{id_autor}','VisitasController@detachAutores');

	Route::get('postgrados/autocompletar/{nombre}/{tipo}', 'PostgradosController@postgradosAjax');
	Route::get('postgrados/showAll/{tipo}', ['as' => 'postgrados.indexAll', 'uses' => 'PostgradosController@indexAll'] );
	Route::get('postgrados/show/{tipo}', ['as' => 'postgrados.index', 'uses' => 'PostgradosController@index'] );
	Route::get('postgrados/create/{tipo}', ['as' => 'postgrados.create', 'uses' => 'PostgradosController@create']  );
	Route::get('postgrados/{id}/edit', ['as' => 'postgrados.edit', 'uses' => 'PostgradosController@edit']  );
	Route::put('postgrados/{id}',  ['as' => 'postgrados.update', 'uses' => 'PostgradosController@update']  );
	Route::post('postgrados/',  ['as' => 'postgrados.store', 'uses' => 'PostgradosController@store']  );
	Route::post('postgrados/search',  ['as' => 'postgrados.search', 'uses' => 'PostgradosController@search']  );
	Route::delete('postgrados/{id}/{tipo}', ['as' => 'postgrados.destroy', 'uses' => 'PostgradosController@destroy'] );
	Route::get('postgrados/{id}/autores/{id_autor}','PostgradosController@enlazarAutores');
	Route::get('postgrados/detach/{id}/autores/{id_autor}','PostgradosController@detachAutores');

	Route::get('formaciones/autocompletar/{nombre}/{tipo}/{modo}', 'FormacionesController@formacionesAjax');
	Route::get('formaciones/showAll/{tipo}/{modo}', ['as' => 'formaciones.indexAll', 'uses' => 'FormacionesController@indexAll'] );
	Route::get('formaciones/show/{tipo}/{modo}', ['as' => 'formaciones.index', 'uses' => 'FormacionesController@index'] );
	Route::get('formaciones/create/{tipo}/{modo}', ['as' => 'formaciones.create', 'uses' => 'FormacionesController@create']  );
	Route::get('formaciones/{id}/edit', ['as' => 'formaciones.edit', 'uses' => 'FormacionesController@edit']  );
	Route::put('formaciones/{id}',  ['as' => 'formaciones.update', 'uses' => 'FormacionesController@update']  );
	Route::post('formaciones/search',  ['as' => 'formaciones.search', 'uses' => 'FormacionesController@search']  );

	Route::post('formaciones/',  ['as' => 'formaciones.store', 'uses' => 'FormacionesController@store']  );
	Route::delete('formaciones/{id}/{tipo}/{modo}', ['as' => 'formaciones.destroy', 'uses' => 'FormacionesController@destroy'] );
	Route::get('formaciones/{id}/autores/{id_autor}','FormacionesController@enlazarAutores');
	Route::get('formaciones/detach/{id}/autores/{id_autor}','FormacionesController@detachAutores');


	Route::get('programasDeIntercambio/autocompletar/{nombre}/{tipo}', 'ProgramasDeIntercambioController@programasDeIntercambioAjax');
	Route::get('programasDeIntercambio/showAll/{tipo}', ['as' => 'programasDeIntercambio.indexAll', 'uses' => 'ProgramasDeIntercambioController@indexAll'] );
	Route::get('programasDeIntercambio/show/{tipo}', ['as' => 'programasDeIntercambio.index', 'uses' => 'ProgramasDeIntercambioController@index'] );
	Route::get('programasDeIntercambio/create/{tipo}', ['as' => 'programasDeIntercambio.create', 'uses' => 'ProgramasDeIntercambioController@create']  );
	Route::get('programasDeIntercambio/{id}/edit', ['as' => 'programasDeIntercambio.edit', 'uses' => 'ProgramasDeIntercambioController@edit']  );
	Route::put('programasDeIntercambio/{id}',  ['as' => 'programasDeIntercambio.update', 'uses' => 'ProgramasDeIntercambioController@update']  );
	Route::post('programasDeIntercambio/',  ['as' => 'programasDeIntercambio.store', 'uses' => 'ProgramasDeIntercambioController@store']  );
	Route::post('programasDeIntercambio/search',  ['as' => 'programasDeIntercambio.search', 'uses' => 'ProgramasDeIntercambioController@search']  );
	Route::delete('programasDeIntercambio/{id}/{tipo}', ['as' => 'programasDeIntercambio.destroy', 'uses' => 'ProgramasDeIntercambioController@destroy'] );
	Route::get('programasDeIntercambio/{id}/profesor/{id_autor}','ProgramasDeIntercambioController@enlazarProfesor');
	Route::get('programasDeIntercambio/detach/{id}/profesor/{id_autor}','ProgramasDeIntercambioController@detachProfesor');


	// PERMISOS
	Route::get('permisos', ['as' => 'permisos.ver', 'uses' => 'PermissionController@show','middleware' => ['permission:permission-create']]);
	Route::post('permisos/store', ['as' => 'permisos.store', 'uses' => 'PermissionController@store']);
	Route::get('permisos/{id}/edit', ['as'=>'permisos.edit','uses'=>'PermissionController@edit','middleware' => ['permission:permission-edit']]);
	Route::put('permisos/{id}',['as'=>'permisos.update','uses'=>'PermissionController@update','middleware' => ['permission:permission-edit']]);
	Route::get('permisos/pdf',['as'=>'permisos.pdf','uses'=>'PermissionController@permisosPDF','middleware' => ['permission:permission-list']]);
	Route::get ('permisos/excel/{tipo}', ['as'=>'permisos.excel','uses'=>'PermissionController@permisosExcel','middleware' => ['permission:permission-list']] );
	Route::delete('permisos/{id}', ['as' => 'permisos.borrar', 'uses' => 'PermissionController@destroy','middleware' => ['permission:permission-delete']]);
	// ROLES
	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	// VIDEO STREAM
	Route::get('/video/{filename}', function ($filename) {
	    // Pasta dos videos.
	    $videosDir = base_path('resources/assets/videos');
	    if (file_exists($filePath = $videosDir."/".$filename)) {
	        $stream = new \App\Http\VideoStream($filePath);
	        return response()->stream(function() use ($stream) {
	            $stream->start();
	        });
	    }
	    return response("File doesn't exists", 404);
	});


	// PDF CREAR
	Route::get ('github', 'PdfController@github');
	// ENVIAR EMAIL
	Route::get('email', function() {

		$data = ['link' => 'http://styde.net'];
	    \Mail::send('emails.welcome', $data, function ($message) {
	        $message->to('user@example.com')
	        ->from('email@styde.net', 'Styde.Net')
	        ->subject('Hello word');
    	});
	    return "Se envío el email";
	});

	Route::get('emailBueno', function() {
		$user =  App\User::find(1);
	    \Mail::to('email@styde.net', 'Styde.Net')
	        ->send(new WelcomeEmail($user));
	    return "Se envío el email Mailable";
	});
	// LIMPIAR CACHE Y MIERDAS
	Route::get('limpiar', ['as' => 'limpiar',  function () {

	    $exitCode = Artisan::call('config:cache');
	    $exitCode = Artisan::call('view:clear');
	    $exitCode = Artisan::call('optimize');
		//$exitCode = Artisan::call('route:cache');
		\Cache::flush();
	    return '<h2>Clear All Cache</h2>
	    <code>php artisan cache:clear, DONE!</code><br>
	    <code>php artisan config:cache, DONE!</code><br>
	    <code>php artisan view:clear, DONE!</code><br>
	    <code>php artisan optimize, DONE!</code><br>
	    <code>php artisan \Cache::flush, DONE!</code>';
	}]);
});
Auth::routes();
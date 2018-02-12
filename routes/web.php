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

Route::get('/', function () {
	\Session::forget('locale');
    return view('welcome');
    // return view('prueba');
});

Route::auth();
Route::group(['middleware' => ['auth']], function() {
	Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
	//Route::post('accion/ajaxInput', ['as' => 'ajax', 'uses' => 'ClientesController@ajaxInput']);

	// ARCHIVOS E IMAGENES
	Route::get('file-upload','ImageController@imageUpload');
	Route::post('file-upload','ArchivosController@uploadFile');
	Route::post('file-delete/{id}','ArchivosController@deleteFile');

	Route::get('autor/autocompletar','AutorController@autoresAjax');
	Route::resource('users','UserController');
	Route::resource('autor','AutorController');
	Route::post('autor/insertAjax','AutorController@storeAjax');

	Route::resource('grupoInvestigacion','GrupoInvestigacionController');
	Route::get('grupoInvestigacion/{id}/responsable/{id_autor}','GrupoInvestigacionController@enlazarResponsable');
	Route::get('grupoInvestigacion/{id}/participante/{id_autor}','GrupoInvestigacionController@enlazarParticipante');
	Route::get('grupoInvestigacion/detach/{id}/responsable/{id_autor}','GrupoInvestigacionController@detachResponsable');
	Route::get('grupoInvestigacion/detach/{id}/participante/{id_autor}', 'GrupoInvestigacionController@detachParticipante');

	Route::resource('congresos','CongresosController');
	Route::get('congresos/{id}/profesor/{id_autor}','CongresosController@enlazarProfesor');
	Route::get('congresos/detach/{id}/profesor/{id_autor}','CongresosController@detachProfesor');

	Route::resource('equipamientoNuevo','EquipamientoNuevoController');

	Route::get('tesisDoctorales/show/{tipo}', ['as' => 'tesisDoctorales.index', 'uses' => 'TesisDoctoralesController@index'] );
	Route::get('tesisDoctorales/create/{tipo}', ['as' => 'tesisDoctorales.create', 'uses' => 'TesisDoctoralesController@create']  );
	Route::get('tesisDoctorales/{id}/edit', ['as' => 'tesisDoctorales.edit', 'uses' => 'TesisDoctoralesController@edit']  );
	Route::put('tesisDoctorales/{id}',  ['as' => 'tesisDoctorales.update', 'uses' => 'TesisDoctoralesController@update']  );
	Route::post('tesisDoctorales/',  ['as' => 'tesisDoctorales.store', 'uses' => 'TesisDoctoralesController@store']  );
	Route::delete('tesisDoctorales/{id}/{tipo}', ['as' => 'tesisDoctorales.destroy', 'uses' => 'TesisDoctoralesController@destroy'] );
	Route::get('tesisDoctorales/{id}/director/{id_autor}','TesisDoctoralesController@enlazarDirector');
	Route::get('tesisDoctorales/{id}/doctorando/{id_autor}','TesisDoctoralesController@enlazarDoctorando');
	Route::get('tesisDoctorales/detach/{id}/director/{id_autor}','TesisDoctoralesController@detachDirector');
	Route::get('tesisDoctorales/detach/{id}/doctorando/{id_autor}', 'TesisDoctoralesController@detachDoctorando');


	Route::get('proyectos/show/{tipo}', ['as' => 'proyectos.index', 'uses' => 'ProyectosController@index'] );
	Route::get('proyectos/create/{tipo}', ['as' => 'proyectos.create', 'uses' => 'ProyectosController@create']  );
	Route::get('proyectos/{id}/edit', ['as' => 'proyectos.edit', 'uses' => 'ProyectosController@edit']  );
	Route::put('proyectos/{id}',  ['as' => 'proyectos.update', 'uses' => 'ProyectosController@update']  );
	Route::post('proyectos/',  ['as' => 'proyectos.store', 'uses' => 'ProyectosController@store']  );
	Route::delete('proyectos/{id}/{tipo}', ['as' => 'proyectos.destroy', 'uses' => 'ProyectosController@destroy'] );
	Route::get('proyectos/{id}/director/{id_autor}','ProyectosController@enlazarDirector');
	Route::get('proyectos/{id}/doctorando/{id_autor}','ProyectosController@enlazarInvestigador');
	Route::get('proyectos/detach/{id}/director/{id_autor}','ProyectosController@detachDirector');
	Route::get('proyectos/detach/{id}/doctorando/{id_autor}', 'ProyectosController@detachInvestigador');

	Route::get('publicaciones/show/{tipo}', ['as' => 'publicaciones.index', 'uses' => 'PublicacionesController@index'] );
	Route::get('publicaciones/create/{tipo}', ['as' => 'publicaciones.create', 'uses' => 'PublicacionesController@create']  );
	Route::get('publicaciones/{id}/edit', ['as' => 'publicaciones.edit', 'uses' => 'PublicacionesController@edit']  );
	Route::put('publicaciones/{id}',  ['as' => 'publicaciones.update', 'uses' => 'PublicacionesController@update']  );
	Route::post('publicaciones/',  ['as' => 'publicaciones.store', 'uses' => 'PublicacionesController@store']  );
	Route::delete('publicaciones/{id}/{tipo}', ['as' => 'publicaciones.destroy', 'uses' => 'PublicacionesController@destroy'] );
	Route::get('publicaciones/{id}/autores/{id_autor}','PublicacionesController@enlazarAutores');
	Route::get('publicaciones/detach/{id}/autores/{id_autor}','PublicacionesController@detachAutores');

	Route::get('programasDeIntercambio/show/{tipo}', ['as' => 'programasDeIntercambio.index', 'uses' => 'ProgramasDeIntercambioController@index'] );
	Route::get('programasDeIntercambio/create/{tipo}', ['as' => 'programasDeIntercambio.create', 'uses' => 'ProgramasDeIntercambioController@create']  );
	Route::get('programasDeIntercambio/{id}/edit', ['as' => 'programasDeIntercambio.edit', 'uses' => 'ProgramasDeIntercambioController@edit']  );
	Route::put('programasDeIntercambio/{id}',  ['as' => 'programasDeIntercambio.update', 'uses' => 'ProgramasDeIntercambioController@update']  );
	Route::post('programasDeIntercambio/',  ['as' => 'programasDeIntercambio.store', 'uses' => 'ProgramasDeIntercambioController@store']  );
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


	Route::get ('pruebapdf', 'PdfController@pdfPrueba');

	// PDF CREAR
	Route::get ('github', 'PdfController@github');
	// ENVIAR EMAIL
	Route::get('email', function() {
		$user =  App\User::find(3);
		Mail::to('unai@example.com', 'Unai')
		->send( new  WelcomeEmail($user));
	    return "Se envío el email, pero solo LOGS ";
	});
	// LIMPIAR CACHE Y MIERDAS
	Route::get('limpiar', ['as' => 'limpiar',  function () {
		$exitCode = Artisan::call('cache:clear');
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
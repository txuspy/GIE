<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    /** @test */
    public function home()
    {
        $this->visit('/')
             ->see('Gipuzkoako Ingeniaritza Eskola');
    }

    /** @test */
    public function no_logueado()
    {
        $this->get('/users')->assertRedirectedTo('/login');
    }

    /** @test */
    public function si_logueado()
    {
        \Auth::loginUsingId(1);
        $response = $this->get(route('home'));
    }

    /** @test */
    public function crearUsuario()
    {
       $usuario = factory(\App\User::class)->create();
       \Auth::loginUsingId($usuario->id);
       $response = $this->get(route('home'));
       $response->assertResponseStatus(200);
       $this->seeInDatabase('users', [
            'email' => $usuario->email
        ]);
    }

     /** @test */
    public function crear_fomacion()
    {
        \Auth::loginUsingId(1);
        $formacion = factory(\App\Formaciones::class)->create();
        $response = $this->get(route('home'));
        $response->assertResponseStatus(200);
        $this->seeInDatabase('formaciones', [
            'titulo_eu' => $formacion->titulo_eu
        ]);
    }


    /** @test */
    public function proyecto_enlazar_director()
    {
        \Auth::loginUsingId(1);
        $this->get('proyectos/2/director/1')
        ->seeInDatabase('proyectosInvestigacionDirectores', [
            'id_autor'    => '1',
            'id_proyecto' => '2'
        ]);
    }

    /** @test */
    public function proyecto_detach_director()
    {
        \Auth::loginUsingId(1);
        $this->get('proyectos/detach/2/director/226')
        ->missingFromDatabase('proyectosInvestigacionDirectores', [
            'id'          =>'1',
            'id_autor'    => '226',
            'id_proyecto' => '2'
        ]);
    }

    /** @test */
    public function proyecto_enlazar_investigador()
    {
        \Auth::loginUsingId(1);
        $this->get('proyectos/2/doctorando/2')
        ->seeInDatabase('proyectosInvestigacionInvestigadores', [
            'id_autor'    => '1',
            'id_proyecto' => '2'
        ]);
    }

     /** @test */
    public function proyecto_detach_investigador()
    {
        \Auth::loginUsingId(1);
        $this->get('proyectos/detach/2/doctorando/94')
        ->missingFromDatabase('proyectosInvestigacionInvestigadores', [
            'id'          => '1',
            'id_autor'    => '94',
            'id_proyecto' => '2'
        ]);
    }

    /** @test */
    public function crear_word()
    {



    }

    /** @test */
    public function error_404()
    {
        \Auth::loginUsingId(9);
        $this->get('/ej/dsdfsde')->see('Opsssss!!.... HTTP 404 Not Found');
    }
    /** @test */
    public function usuario_con_secret_de_password()
    {
        \Auth::loginUsingId(9);
       /* $this->get('/users/9/edit')
        ->see('Aurretik zehaztutako pasahitza aldatu beharra dago');*/
    }

     /** @test */
    public function usuario_sin_permiso()
    {
        \Auth::loginUsingId(9);
       $this->get('/users')
       ->see('Ez dituzu permisorik');

    }
     /** @test */
    public function usuario_con_permiso()
    {
        \Auth::loginUsingId(1);
        $this->get('/users')->see('Usuarios');

    }

}

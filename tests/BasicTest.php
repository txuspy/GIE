<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{

    use DatabaseMigrations;
    /**
        @test
        @group clientes
    */
    public function pagina_principal()
    {
        $usuario = factory(\App\User::class)->create();

        \Auth::loginUsingId($usuario->id);
        // \Auth::loginUsingId('1');

        // $response = $this->get(route('home')); //5.4
        $response = $this->call('GET', '/home');

        // $response->assertStatus(200); //5.4
        $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     * @group clientes
    */
    public function lista_clientes(){
        // $usuario = factory(\App\User::class)->create();
        $clientes = factory(\App\Clientes::class, 200)->make();

        // \Auth::loginUsingId($usuario->id);
        \Auth::loginUsingId('1');

        $this->visit('/customer/tipo/1');
        foreach( $clientes as $cliente){
            // $response->assertSee($cliente->id_cliente);  // 5.4
            // $this->seeInDatabase('clientes', ['id_cliente' => $cliente->id_cliente]);
            $this->see($cliente->id_cliente);
        }
    }
}

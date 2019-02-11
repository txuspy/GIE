<?php

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \App\User;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

	public function iniciarSuperUsuario(){
		$user = \Auth::loginUsingId('1');
    	\Session::put('locale', $user->lng );
    	\Session::put('locale_key', array_search( $user->lng, config('app.supported-locales3') ));
	}

}
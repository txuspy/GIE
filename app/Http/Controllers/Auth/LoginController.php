<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Autor;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $redirectAfterLogout ='/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->redirectTo = \App\Lib\Functions::parseLang().'/home';
        $this->middleware('guest', ['except' => 'logout']);

    }
    /**/public function username()
    {
        //return 'ldap';
        return 'email';
    }
    public function logout(\Request $request)
    {
         $this->redirectAfterLogout = \App\Lib\Functions::parseLang().'/';
         $this->guard()->logout();
         \Session::forget('locale');
         return redirect($this->redirectAfterLogout);
    }
    protected function authenticated(Request $request, $user)
    {
        //sesion de idioma
        if (in_array($user->lng, config('app.supported-locales'))) {
            \Session::put('locale', $user->lng );
            \Session::put('locale_key', array_search( $user->lng, config('app.supported-locales3') ));
        }else{
            \Session::put('locale', config('app.locale' ));
        }
        // La primera vez estado == 0
        if ( $user->estado == '0' ){
            return redirect()->intended($user->lng.'/users/'.$user->id.'/edit')->with('firstTime', [true]);
            //return redirect()->intended($user->lng.'/users/'.$user->id.'/edit')->withInput()->withSuccess(compact("applicantData"));

        }
    }
}

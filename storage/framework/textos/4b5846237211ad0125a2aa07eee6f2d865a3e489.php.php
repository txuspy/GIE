<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  App\Role;
use  App\GIE01;
use  App\GIE02;
use  App\GIEBERRIA;
use  App\Politekniko3;
use  App\User;
use  App\Autor;
use  Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
        //die("homeControler");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasher = app('hash');
        $passwordCambiar = false;
        if ($hasher->check('secret', \Auth::user()->password)) {
            $user     = User::find(\Auth::user()->id);
            $roles    = Role::pluck('display_name','id');
            $userRole = $user->roles->pluck('id','id')->toArray();
            return view('users.edit',compact('user','roles','userRole' ))->withErrors( 'Aurretik zehaztutako pasahitza aldatu beharra dago<br>Deberías cambiar la contraseña predefinida');
            $passwordCambiar = true ;
        }

        return view('home', compact('passwordCambiar'));
    }

    public function gie()
    {
        die("gie gie");
        // si pasan una lista se mete en mysql crear el modelo y con este script mira si existe y si no lo mete, CUIDADO: los campos como se llaman
        // $gies01 = GIE01::orderBy('lname','ASC')->get();
        $gies02 = Politekniko3::orderBy('lname','ASC')->get();
        $pos=1;
        $usuario = array();
        foreach ($gies02 as $gie02){
            echo $pos.") ".str_replace("*", "", ucwords( mb_strtolower(trim($gie02->name)))). ", ".str_replace("*", "", ucwords(strtolower(trim($gie02->lname)))).", ".trim($gie02->email)."<br>";
            if($gie02->email)
            {
               //dd($gie02);
                $usuario = false;
                $usuario = User::where('email', $gie02->email)->first();
                  if($usuario){
                      echo "--- Existe ".$gie02->email."<br>";
                       $pos++;
                  }else{
                    // Seteo usuario
                    $input['password'] = Hash::make('secret');
                    // $input['id']  = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->id   ))));
                    $input['name']  = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->name   ))));
                    $input['lname'] = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->lname))));
                    $input['email'] = trim($gie02->email);
                    //creo usuario
                    $user = false;
                    $user = User::create($input);
                    //Role profesor
                    $user->attachRole('4');
                    // Autor
                    $valores = [
                       'user_id'  => $user->id,
                       'nombre'   => $user->name,
                       'apellido' => $user->lname,
                       'tipo'     => "EHU"
                    ];
                    $autor = Autor::create($valores);
                    $valorUpdate['id_autor'] = $autor->id;
                    $user->update($valorUpdate);

                    $pos++;
                }
            }
        }
    //   / $gies02 = Politekniko3::orderBy('id','DESC')->get();

    }
}

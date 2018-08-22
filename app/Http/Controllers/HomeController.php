<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  App\Role;
use  App\GIE01;
use  App\GIE02;
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
        $this->middleware('auth');
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
             $passwordCambiar = true ;
        }

        return view('home', compact('passwordCambiar'));
    }

    public function gie()
    {

        //$gies01 = GIE01::orderBy('apellidos','ASC')->get();
        $gies02 = GIE02::orderBy('apellidos','ASC')->get();
        $pos=1;
        $usuario = array();
        foreach ($gies02 as $gie02){
            echo $pos.") ".str_replace("*", "", ucwords( mb_strtolower(trim($gie02->nombre)))). ", ".str_replace("*", "", ucwords(strtolower(trim($gie02->apellidos)))).", ".trim($gie02->email)."<br>";
            if($gie02->email)
            {
                $usuario = false;
                $usuario = User::where('email', $gie02->email)->first();
                  if($usuario){
                      echo "--- Existe ".$gie02->email."<br>";
                  }else{
                    // Seteo usuario
                    $input['password'] = Hash::make('secret');
                    // $input['id']  = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->id   ))));
                    $input['name']  = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->nombre   ))));
                    $input['lname'] = str_replace("*", "", ucwords(mb_strtolower(trim($gie02->apellidos))));
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
        $gies02 = GIE02::orderBy('id','DESC')->get();

    }
}

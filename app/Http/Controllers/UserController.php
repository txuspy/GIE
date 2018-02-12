<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\StorageController;
use App\User;
use App\Autor;
use App\Role;
use App\Imagenes;
use App\ImagenesRelacion;
use DB;
use Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public  $user;
     public function index(Request $request){
        $data = User::orderBy('lname','ASC')->paginate(25);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
     }

    public function create()
    {

        $roles = Role::pluck('display_name','id');

        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'ldap'     => 'required|unique:users,ldap',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles'    => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['name']  = ucfirst(strtolower(trim($input['name'])));
        $input['lname'] = ucfirst(strtolower(trim($input['lname'])));

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        $valores = [
           'user_id'  => $user->id,
           'nombre'   => $user->name,
           'apellido' => $user->lname
        ];
        $autor = Autor::create($valores);

        return redirect()->route('users.index')
                        ->with('success', __('Erabiltzailea zuzen sortu da'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole', 'imagenes', 'adjuntos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required',
            'lname'    => 'required',
            'ldap'     => 'required',
            'email'    => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password'
        ]);

        $input          = $request->all();
        $input['name']  = ucfirst(strtolower(trim($input['name'])));
        $input['lname'] = ucfirst(strtolower(trim($input['lname'])));

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        if(!empty($request->input('roles'))){
            DB::table('role_user')->where('user_id',$id)->delete();
            foreach ($request->input('roles') as $key => $value) {
                $user->attachRole($value);
            }
        }
        if ( empty($user->autor) ){
           $valores = [
                'user_id'   => $id,
                'nombre'    => ucfirst(strtolower(trim($user->name))),
                'apellido'  => ucfirst(strtolower(trim($user->lname))),
                'tipo'      => 'EHU'
            ];
            $autor = Autor::create($valores);
        }else{
            $autor = Autor::find($user->autor->id);
            $valores = [
               'nombre'  => ucfirst(strtolower(trim($user->name))),
               'apellido'  => ucfirst(strtolower(trim($user->lname))),

            ];
            $autor->update($valores);
        }
        return redirect()->route('users.index')->with('success', __('Erabiltzailea zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success', __('Erabiltzailea zuzen ezabatu da'));
    }
    public static function getUserName($user_id)
    {
        $user = User::where('user_id', $user_id)->get();
        if(empty($user)){ return '---';}
        return $user->name.' '.$user->lname;
    }
}

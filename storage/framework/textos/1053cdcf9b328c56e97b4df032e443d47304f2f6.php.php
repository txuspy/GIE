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
use App\Lib\Functions;
use Session;

class UserController extends Controller
{
    public  $user;
    public function index(Request $request){
        if(\Auth::user()->hasRole('owner') OR \Auth::user()->hasRole('admin')){
            $data = User::orderBy('lname','ASC')->paginate(25);
            return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        }else{
            $passwordCambiar = false;
            return view('home', compact('passwordCambiar'))->withErrors(__('Ez dituzu permisorik'));
        }
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
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles'    => 'required'
        ]);//'ldap'     => 'required|unique:users,ldap',
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $input['name']  = trim($input['name']);
        $input['lname'] = trim($input['lname']);

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
        $valorUpdate['id_autor'] = $autor->id;
        $user->update($valorUpdate);
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

            return view('users.edit',compact('user','roles','userRole' ));

    }

    public function update(Request $request, $id)
    {
        if(\Auth::user()->hasRole('owner') OR \Auth::user()->hasRole('admin')){

        }else{
            $passwordCambiar = false;
            return view('home', compact('passwordCambiar'))->withErrors(__('Ez dituzu permisorik'));
        }
        $this->validate($request, [
            'name'     => 'required',
            'lname'    => 'required',
            'email'    => 'required|email|unique:users,email,'.$id
        ]);// 'ldap'     => 'required',

        $input          = $request->all();
        $input['name']  = trim($input['name']);
        $input['lname'] = trim($input['lname']);

        $input['estado'] = '1';
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
        if ( empty($user->autor) OR ($user->autor == '0') ){
           $valores = [
                'user_id'   => $id,
                'nombre'    => trim($input['name']),
                'apellido'  => trim($input['lname']),
                'tipo'      => 'EHU'
            ];
            $autor = Autor::create($valores);
            $input['id_autor'] = $autor->id;
            $user->update($input);
        }else{
            $autor = Autor::find($user->autor->id);
            $valores = [
               'nombre'    => trim($user->name),
               'apellido'  => trim($user->lname),

            ];
            $autor->update($valores);
            $input['id_autor'] = $autor->id;
            $user->update($input);
        }


        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();
        \Session::put('locale', $request->lng);
        \LaravelGettext::setLocale($request->lng) ;
        $passwordCambiar =false;
        return redirect()->route('home', $passwordCambiar)->with('success', __('Erabiltzailea zuzen aldatatu da'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success', __('Erabiltzailea zuzen ezabatu da'));
    }

    private function crearSql($q, $request = false)
	{


	    if(isset($request['name'])) {
			if($request['name'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('name', 'like', "%".$request['name']."%");
				});
			}
		}

	    if(isset($request['lname'])) {
			if($request['lname'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('lname', 'like', "%".$request['lname']."%");
				});
			}
		}


        if(isset($request['email'])) {
			if($request['email'] != '') {
				$q->where(function ($query) use ($request) {
					return $query->where('email', $request['email'] );
				});
			}
		}





		return $q;
	}

    public function search(Request $request)
    {

        $q    = User::query();
        $q    = $this->crearSql($q, $request);
        $data = $q
                ->orderBy('id','DESC')
                ->paginate(25);
        $sql  = Functions::getSql($q, $q->toSql());
       // dd($sql );
        $tipo = $request['tipo'];


        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public static function getUserName($user_id)
    {
        $user = User::where('user_id', $user_id)->get();
        if(empty($user)){ return '---';}
        return $user->name.' '.$user->lname;
    }
}

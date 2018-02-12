<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\StorageController;
use App\User;
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
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
        $imagenes = new ImageController();
        $imagenes = $imagenes->dameImagenes( 'user_', $id, '1');
        $adjuntos = new StorageController();
        $adjuntos = $adjuntos->dameAdjuntos( 'user_', $id);

        return view('users.edit',compact('user','roles','userRole', 'imagenes', 'adjuntos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        $user = User::find($id);
        $user->update($input);



        DB::table('role_user')->where('user_id',$id)->delete();

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    public static function getUserName($user_id)
    {
        $user = User::where('user_id', $user_id)->get();
        if(empty($user)){ return '---';}
        return $user->name.' '.$user->lname;
    }
}

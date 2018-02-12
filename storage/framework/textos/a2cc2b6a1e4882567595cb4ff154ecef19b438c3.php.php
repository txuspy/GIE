<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

use App\Permission;
use Eloquent;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use Breadcrumbs;


class PermissionController extends Controller
{
	public function __construct(){

	}

    /**
     *
     */
    public function create()
	{

	}
	public function store(Request $request)
	{
		if($request->ajax()){
			$this->validate($request, [
				'name' => 'required|unique:roles,name',
				'display_name' => 'required',
				'description' => 'required',
				]);
			$permiso= new Permission();
			$permiso->name = $request->input('name');
			$permiso->display_name = $request->input('display_name');
			$permiso->description = $request->input('description');
			$permiso->save();
			return response()->json([
				"mensaje"=>$request->input('name') ,
				"id"=> $permiso->id
				]);
		}
	}
	public function show()
	{
		$permisos = Permission::orderBy('id', 'desc')->paginate(10);

		return view('permisos.index', compact('permisos'));
	}
	public function pdf($id)
	{
		$permiso =  Permission::find($id);

		return \PDF::loadView('permisos.edit', compact('permiso'))->download('permisos.pdf');
	}

	public function edit($id)
	{
		$permiso =  Permission::find($id);
		return view('permisos.edit', compact('permiso'));
	}
	public function update(Request $request, $id)
	{
		$permiso = Permission::find($id);
		$nombreCampo =$request->input('nombreCampo');
		$permiso->$nombreCampo = $request->input('valorCampo');
		$permiso->save();
		return  response()->json([
			"mensaje"=> "ok"
			]);
	}
	public function destroy($id)
	{
		Permission::find($id)->delete();
		return  response()->json([
			"mensaje"=>$id
			]);
	}
	public function permisosExcel(Request $request)
	{
		Excel::create('Laravel Excel', function($excel) {
		 // Set the title
			$excel->setTitle('Our new awesome title');

		    // Chain the setters
			$excel->setCreator('Maatwebsite')
			->setCompany('Maatwebsite');

		    // Call them separately
			$excel->setDescription('A demonstration to change the file properties');
			$excel->sheet('Permisos', function($sheet) {

				$permisos = Permission::all();

				$sheet->fromArray($permisos);

			});
		})->download($request->tipo);
	}
	 public function permisosPDF(Request $request){
		$date = new \Carbon\Carbon();
		$permisos = Permission::orderBy('id', 'desc')->paginate(100);
		return \PDF::loadView('permisos.indexPdf', compact('permisos'))->download($date.'permisos.pdf');
    }
}

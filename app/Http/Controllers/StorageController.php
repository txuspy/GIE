<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lib\Functions;
use App\Adjuntos;
use App\AdjuntosRelacion;

use Input;
use DB;

class StorageController extends Controller
{
	public static function fileUploadPost(Request $request, $a)
 	{
		 $funcionesGenerales = new Functions();
			$configuracion = $funcionesGenerales->workFiles($request->input('tipo'));
			if( $request->hasFile('archivo'.$a) ){
				$url    = false;
				$file   = $request->file('archivo'.$a);
				$nombre = time().$a.'.'.$file->getClientOriginalExtension();
				$path   = $configuracion['ruta'].$nombre;
				$url    = '/down/'.$configuracion['ruta'].$nombre;
				$size   =  \File::size($file);
				if ( $size >= '4194304' ){
					return "<p>Max 4 Mb Allowed</p>";
				}else{
					\Storage::disk('local')->put($path,  \File::get($file));
					$adjunto = new Adjuntos();
					$adjunto->nom_adjunto = $nombre;
					$adjunto->title_adjunto = $file->getClientOriginalName();
					$adjunto->save();

					$adjRelacion = new AdjuntosRelacion();
					$adjRelacion->id_adjunto = $adjunto->id_adjunto;
					$adjRelacion->id_objeto = $configuracion['pre'].$request->input('attrId');
					$adjRelacion->save();
				}
		}else{
			return "<br><br>NO existe archivo: archivo.".$a."<br>";
		}
		if(isset($url)){
			return "<p>&nbsp; &nbsp; ".$a.".) FILE UPLOAD <a href='".$url."'> ( ".$file->getClientOriginalName()." ) </a></p>";
		}
		return "<br><br>NO se pq esta aqui SOCORRO";
	}
	public static function fileDeletePost(Request $request){

		$route  = public_path('down/'.$request->input('tipo').'/'.$request->input('nomFile'));
		if(	\File::delete($route)){
			if( \App\Adjuntos::destroy($request->input('idFile')) ){

			}
		}
		return "DELETED";
	}
	public  function dameAdjuntos( $tipo, $id){
		$adjuntos = DB::table('adjunto_relacion')
			->join('adjunto', 'adjunto.id_adjunto', '=', 'adjunto_relacion.id_adjunto')
			->where('adjunto_relacion.id_objeto', 'user_'.$id)
			->get();

		if(!empty($adjuntos)){
			return $adjuntos;
		}else{
			return false;
		}
	}
}

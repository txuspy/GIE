<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Functions;
use App\Imagenes;
use App\ImagenesRelacion;

use Images;
use Input;
use DB;

class ImageController extends Controller
{
	public  function __construct() {
   }
	public function imageUpload()
	{
		//return view('files.image-upload');
	}
	public static function imageUploadPost(Request $request, $a)
	{
		$funcionesGenerales = new Functions();
		$configuracion = $funcionesGenerales->workFiles($request->input('tipo'));
		if( $request->hasFile('archivo'.$a) ){
			$cuantos =  false;
			$url     = false;
			$cuantos = $configuracion['cuantos']++;
			for ($i=1; $i <= $cuantos ; $i++) {
				$file[$i]      = $request->file('archivo'.$a);
				$imageName[$i] = time().$a.$i.'.'.$file[$i]->getClientOriginalExtension();
				$path[$i]      = public_path('images/'.$configuracion['ruta'].$imageName[$i]);
				$url           = '/images/'.$configuracion['ruta'].$imageName[$i];
				$image[$i]     = Images::make( $file[$i]->getRealPath() );
				$image[$i]->resize($configuracion['ta_X'][$i], $configuracion['ta_Y'][$i], function($c){
					$c->aspectRatio();
				});
				$size[$i]      =  $image[$i]->filesize();
				if ( $size[$i] >= '4194304' ){
					return "<p>Max 4 Mb Allowed</p>";
				}else{
					$image[$i]->save($path[$i], '100');
					$imagen = new Imagenes();
					$imagen->tamano_imagenes = $i;
					$imagen->nom_imagenes = $imageName[$i];
					$imagen->title_imagenes = $file[$i]->getClientOriginalName();
					$imagen->save();
					$imgRelacion = new ImagenesRelacion();
					$imgRelacion->id_imagenes = $imagen->id_imagenes;
					$imgRelacion->id_objeto = $configuracion['pre'].$request->input('attrId');
					$imgRelacion->save();
				}
			}
		}else{
			return "<br><br>NO existe archivo: archivo.".$a."<br>";
		}
		if(isset($url)){
			return  '<img class="pull-left" src="'.$url.'">';
		}
		return "<br><br>NO se pq esta aqui SOCORRO";
		/*
		$this->validate($request, [
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);
		return back()
			->with('success','Image Uploaded successfully.')
			->with('path',$path.$imageName);
		*/
	}
	public static function imageDeletePost(Request $request){
		$funcionesGenerales = new Functions();
		$configuracion      = $funcionesGenerales->workFiles($request->input('tipo'));
		$fileName           = substr($request->input('nomFile'), 0, -5);
		$fileExtension      = substr($request->input('nomFile'), -4);
		$id                 = $request->input('idFile') - 1 ;
		if( $request->input('tamanoFile')!='1'){
			return "No se puede borrar, tamaño foto 2 tiene q ser ".$request->input('tamano')." para borrar correctamente en cascada";
		}
		for ($i=1; $i <= $configuracion['cuantos']  ; $i++) {
		//	$route  = public_path('images/'.$request->input('tipo').'/'.$fileName.$i.$fileExtension);
			$route  = public_path('images/'.$configuracion['ruta'].'/'.$fileName.$i.$fileExtension);
			$idFile = ( $id + $i );
			if(	\File::delete($route)){
				if( \App\Imagenes::destroy($idFile) ){
				}
			}
		}
		return "<p>DELETED</p>";
	}
	public  function dameImagenes( $prefijo, $id, $size=false){
		if($size){
			$imagenes = DB::table('imagenes_relacion')
				->join('imagenes', 'imagenes.id_imagenes', '=', 'imagenes_relacion.id_imagenes')
				->where('imagenes_relacion.id_objeto', $prefijo.$id)
				->where('imagenes.tamano_imagenes', $size)
				->get();
		}else{
			$imagenes = DB::table('imagenes_relacion')
				->join('imagenes', 'imagenes.id_imagenes', '=', 'imagenes_relacion.id_imagenes')
				->where('imagenes_relacion.id_objeto', $prefijo.$id)
				->get();
		}

		if(!empty($imagenes)){
			return $imagenes;
		}else{
			return false;
		}
	}

}

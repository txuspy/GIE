<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Images;
use Input;

class ArchivosController extends Controller
{
    public function uploadFile(Request $request){
        if($request->input('tipoArchivo')=="imagen"){
            $imagenePreview = false;
        	for ($i=1; $i <= $request->input("cuantosArchivos") ; $i++) {
        		$imagenePreview .= ImageController::imageUploadPost($request, $i);
        	}
            return $imagenePreview;
        }
        if($request->input('tipoArchivo')=="archivo"){
            $archivoPeview = false;
            for ($i=1; $i <= $request->input("cuantosArchivos") ; $i++) {
                $archivoPeview .= StorageController::fileUploadPost($request, $i);
            }

            return $archivoPeview;
        }
    }
     public function deleteFile(Request $request){
        if($request->input('tipoArchivo')=="imagen"){
            return ImageController::imageDeletePost($request);
        }
        if($request->input('tipoArchivo')=="archivo"){
            //return "estoy dentro de archivos controller";
            return StorageController::fileDeletePost($request);
        }
    }
}

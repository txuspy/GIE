<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenesRelacion extends Model
{

	protected $table      = 'imagenes_relacion';
	protected $primaryKey = "id_img_rel";
	public $timestamps    = false;
	protected $fillable   = ['id_imagenes','id_objeto'];



}

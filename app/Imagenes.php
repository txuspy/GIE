<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table      = 'imagenes';
	protected $primaryKey = "id_imagenes";
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable   = ['nom_imagenes', 'tamano_imagenes', 'title_imagenes'];
	public function imagenesRelacion()
	{

	}
}

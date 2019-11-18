<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table      = 'adjunto';
	protected $primaryKey = "id_adjunto";
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable   = ['nom_adjunto', 'orden_adjunto'];
	public function AdjuntosRelacion()
	{

	}
}

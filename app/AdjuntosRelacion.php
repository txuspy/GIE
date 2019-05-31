<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntosRelacion extends Model
{

	protected $table      = 'adjunto_relacion';
	protected $primaryKey = "id";

	protected $fillable   = ['id_adjunto','id_objeto'];

	public $timestamps    = false;



}

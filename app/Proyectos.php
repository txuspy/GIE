<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyectos extends Model
{
    protected $table      = "proyectoInvestigacion";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'proyecto_eu', 'proyecto_es', 'financinacion', 'desde',  'hasta'
    ];


     public function investigadores()
    {
        return $this->belongsToMany(Autor::class, 'proyectosInvestigacionInvestigadores', 'id_proyecto', 'id_autor');
    }
    public function directores()
    {
        return $this->belongsToMany(Autor::class, 'proyectosInvestigacionDirectores',  'id_proyecto', 'id_autor');
    }
}
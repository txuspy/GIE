<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class GrupoInvestigacion extends Model
{
    protected $table = "GrupoInvestigacion";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id',  'grupo_eu', 'grupo_es',  'lineasInv_es', 'lineasInv_eu', 'desde', 'hasta'
    ];

    public function participantes()
    {
        return $this->belongsToMany(Autor::class, 'GrupoInvestigacionParticipantes', 'id_grupoInvestigacion', 'id_autor');
    }
    public function responsables()
    {
        return $this->belongsToMany(Autor::class, 'GrupoInvestigacionResponsables',  'id_grupoInvestigacion', 'id_autor');
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TesisDoctorales extends Model
{
    protected $table = "tesisDoctorales";
    use SoftDeletes;
    protected $fillable = [
        'id', 'user_id', 'tipo', 'doctorando', 'titulo_es',  'titulo_eu', 'departamento', 'euskera', 'internacional', 'director', 'fechaLectura','curso'
    ];
    public function doctorandos()
    {
        return $this->belongsToMany(Autor::class, 'tesisDoctoralesDoctorando', 'id_tesisDoctoral', 'id_autor');
    }
    public function directores()
    {
        return $this->belongsToMany(Autor::class, 'tesisDoctoralesDirector',  'id_tesisDoctoral', 'id_autor');
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'id','user_id' );
    }
}

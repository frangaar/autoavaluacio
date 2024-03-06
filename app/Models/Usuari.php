<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuari extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'usuari';
    protected $primaryKey = 'id_usu';
    public $incrementing = false;
    public $timestamps = false;


    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }


    public function moduls()
    {
        return $this->belongsToMany(Modul::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function tipus()
    {
        return $this->belongsTo(TipusUsuari::class, 'tipus_usuaris',);
    }

    public function criteris()
    {
        return $this->belongsToMany(CriteriAvaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id')->withPivot('nota');
    }
}

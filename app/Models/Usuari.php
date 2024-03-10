<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuari extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;


    public function rol()
    {
        return $this->belongsTo(TipusUsuari::class, 'tipus_usuaris_id');
    }


    public function moduls()
    {
        return $this->belongsToMany(Modul::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function criteris()
    {
        return $this->belongsToMany(CriteriAvaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id')->withPivot('nota');
    }
}

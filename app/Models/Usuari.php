<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;

    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;


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

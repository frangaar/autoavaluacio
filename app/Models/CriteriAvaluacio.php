<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriAvaluacio extends Model
{
    use HasFactory;

    protected $table = 'criteris_avaluacio';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function resultat()
    {
        return $this->belongsTo(ResultatAprenentatge::class, 'resultats_aprenentatge_id');
    }

    public function rubriques()
    {
        return $this->hasMany(Rubrica::class, 'criteris_avaluacio_id');
    }

    public function usuaris()
    {
        return $this->belongsToMany(Usuari::class, 'alumnes_has_criteris_avaluacio', 'criteris_avaluacio_id', 'usuaris_id')->withPivot('nota');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultatAprenentatge extends Model
{
    use HasFactory;

    protected $table = 'resultats_aprenentatge';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    public function modul()
    {
        return $this->belongsTo(Modul::class, 'moduls_id');
    }

    public function criteris()
    {
        return $this->hasMany(CriteriAvaluacio::class, 'resultats_aprenentatge_id');
    }
}

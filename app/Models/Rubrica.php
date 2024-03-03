<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    use HasFactory;

    protected $table = 'rubriques';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;


    public function criteri()
    {
        return $this->belongsTo(CriteriAvaluacio::class, 'criteris_avaluacio_id');
    }
}

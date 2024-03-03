<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    use HasFactory;

    protected $table = 'cicles';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * Get all of the moduls for the Cicle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function moduls()
    {
        return $this->hasMany(Modul::class, 'cicles_id');
    }
}

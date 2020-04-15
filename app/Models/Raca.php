<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    protected $table = 'racas';

    public $timestamps = false;

    protected $fillable = [
        'nome', 'especie_id',
    ];

    protected $with = [
        'especie'
    ];

    public function especie()
    {
        return $this->belongsTo(\App\Models\Especie::class, 'especie_id');
    }
}

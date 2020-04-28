<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'data_cadastro',
        'especie_id',
        'cadastrado_por',
        'sexo',
        'cor',
        'porte',
    ];
}

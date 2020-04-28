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
        'raca_id',
        'cliente_id',
        'cadastrado_por',
        'sexo',
        'cor',
        'porte',
    ];
    
    protected $with = [
        'raca',
        'cliente',
    ];

    public function raca() {
        return $this->hasOne(\App\Models\Raca::class, 'id', 'raca_id');
    }
    
    public function cliente() {
        return $this->hasOne(\App\Models\Cliente\Cliente::class, 'id', 'cliente_id');
    }
}
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

    public function raca() {
        return $this->hasOne(\App\Models\Raca::class, 'id', 'raca_id');
    }
    
    public function cliente() {
        return $this->belongsTo(\App\Models\Cliente\Cliente::class, 'cliente_id');
    }

    public function consultas() {
        return $this->hasMany(\App\Models\Consulta::class, 'paciente_id', 'id');
    }
}
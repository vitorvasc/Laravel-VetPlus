<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';

    public $timestamps = false;

    protected $fillable = [
        'observacoes',
        'paciente_id',
        'funcionario_id',
        'data',
    ];

    public function paciente() {
        return $this->hasOne(\App\Models\Paciente::class, 'id', 'paciente_id');
    }

    public function funcionario() {
        return $this->hasOne(\App\Models\User::class, 'id', 'funcionario_id');
    }
}

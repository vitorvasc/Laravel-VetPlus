<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome_completo',
        'cpf',
        'rg',
        'data_cadastro',
        'cadastrado_por',
    ];

    public function cadastradoPor()
    {
        return $this->hasOne(\App\Models\User::class, 'cadastrado_por', 'id');
    }
}

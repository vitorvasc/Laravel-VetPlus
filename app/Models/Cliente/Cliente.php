<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = [
        'nome_completo',
        'cpf',
        'rg',
        'data_cadastro',
        'cadastrado_por',
    ];

    protected $with = [
        'email',
    ];

    public function cadastradoPor()
    {
        return $this->hasOne(\App\Models\User::class, 'cadastrado_por', 'id');
    }

    public function email() {
        return $this->hasOne(\App\Models\Cliente\Email::class, 'cliente_id');
    }
}

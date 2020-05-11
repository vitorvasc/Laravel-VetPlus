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

    public function cadastradoPor()
    {
        return $this->hasOne(\App\Models\User::class, 'cadastrado_por', 'id');
    }

    public function emails() {
        return $this->hasMany(\App\Models\Cliente\Email::class, 'cliente_id', 'id');
    }

    public function enderecos() {
        return $this->hasMany(\App\Models\Cliente\Endereco::class, 'cliente_id', 'id');
    }

    public function telefones() {
        return $this->hasMany(\App\Models\Cliente\Telefone::class, 'cliente_id', 'id');
    }

    public function whatsapp() {
        return $this->hasOne(\App\Models\Cliente\Telefone::class, 'cliente_id', 'id')->where(function ($query) {
            $query->where('whatsapp', 1);
        });
    }

    public function animais() {
        return $this->hasMany(\App\Models\Paciente::class, 'cliente_id', 'id');
    }
}

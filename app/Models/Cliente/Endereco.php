<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'clientes_enderecos';

    protected $fillable = [
        'cliente_id',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
    ];

    public $timestamps = false;
}

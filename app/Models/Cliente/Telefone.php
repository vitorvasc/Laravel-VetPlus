<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'clientes_telefones';

    protected $fillable = [
        'cliente_id',
        'telefone',
    ];

    public $timestamps = false;
}

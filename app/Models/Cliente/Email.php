<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'clientes_emails';

    protected $fillable = [
        'cliente_id',
        'email',
    ];

    public $timestamps = false;
}

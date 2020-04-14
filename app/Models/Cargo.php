<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';

    public function users() {
        return $this->hasMany(\App\Models\Permissao::class, 'cargo_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_completo', 'email', 'password', 'ativo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'permissoes',
    ];

    public function isAdmin()
    {
        return $this->hasOne(\App\Models\Permissao::class, 'usuario_id', 'id')->where(function ($query) {
            $query->where('cargo_id', 1);
        })->exists();
    }

    public function permissoes()
    {
        return $this->hasMany(\App\Models\Permissao::class, 'usuario_id', 'id');
    }
}

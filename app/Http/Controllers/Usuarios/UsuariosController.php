<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'asc')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create() {
        return true;
    }

    public function insert() {
        return true;
    }

    public function edit() {
        return true;
    }

    public function editValidate() {
        return true;
    }
}

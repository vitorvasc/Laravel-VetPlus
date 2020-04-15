<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'asc')->get();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        if (User::where('email', $data['email'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe um usuário cadastrado com este e-mail.'
            ];

            return view('usuarios.create', ['message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Usuário cadastrado com sucesso! A senha foi enviada para o e-mail cadastrado.'
            ];

            User::create([
                'nome_completo' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make('123'),
                'ativo' => 1
            ]);

            $usuarios = User::orderBy('id', 'asc')->get();

            return view('usuarios.index', ['usuarios' => $usuarios, 'message' => $message]);
        }
    }

    public function edit($id)
    {
        $usuario = User::where('id', $id)->first();

        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function editValidate(Request $req, $id)
    {
        $data = $req->all();
        $usuario = User::where('id', $id)->first();

        if (User::where('email', $data['email'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe um usuário cadastrado com este e-mail.'
            ];

            return view('usuarios.edit', ['usuario' => $usuario, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Usuário alterado com sucesso.'
            ];

            $usuario->nome_completo = $data['nome'];
            $usuario->email = $data['email'];
            $usuario->save();

            $usuarios = User::orderBy('id', 'asc')->get();

            return view('usuarios.index', ['usuarios' => $usuarios, 'message' => $message]);
        }
    }

    public function changeStatus($id)
    {
        $usuario = User::where('id', $id)->first();

        if ($usuario->ativo == 1) {
            $usuario->ativo = 0;
            $usuario->save();

            $message = [
                'type' => 'success',
                'text' => 'Usuário desativado com sucesso.'
            ];

            $usuarios = User::orderBy('id', 'asc')->get();

            return view('usuarios.index', ['usuarios' => $usuarios, 'message' => $message]);
        } else {
            $usuario->ativo = 1;
            $usuario->save();

            $message = [
                'type' => 'success',
                'text' => 'Usuário ativado com sucesso.'
            ];

            $usuarios = User::orderBy('id', 'asc')->get();

            return view('usuarios.index', ['usuarios' => $usuarios, 'message' => $message]);
        }
    }
}

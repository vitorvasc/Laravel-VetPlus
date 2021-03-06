<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Permissao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'asc')->get();
        return view('administracao.usuarios.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('administracao.usuarios.create');
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        if (User::where('email', $data['email'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe um usuário cadastrado com este e-mail.'
            ];

            return redirect()->route('site.usuarios.create')->with(['data' => $data, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Usuário cadastrado com sucesso! A senha foi enviada para o e-mail cadastrado. Lembre-se de definir as permissões deste usuário.'
            ];

            $user = User::create([
                'nome_completo' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make('123'),
                'ativo' => 1
            ]);

            return redirect()->route('site.usuarios.edit', $user->id)->with(['message' => $message]);
        }
    }

    public function edit($id)
    {
        $usuario = User::where('id', $id)->first();
        $cargos = Cargo::all();

        return view('administracao.usuarios.edit', ['usuario' => $usuario, 'cargos' => $cargos]);
    }

    public function editValidate(Request $req, $id)
    {
        $data = $req->all();
        $usuario = User::where('id', $id)->first();

        if (User::where('email', $data['email'])->first() && $usuario->email != $data['email']) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe um usuário cadastrado com este e-mail.'
            ];

            return redirect()->route('site.usuarios.edit', $id)->with(['data' => $data, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Usuário alterado com sucesso.'
            ];

            $usuario->nome_completo = $data['nome'];
            $usuario->email = $data['email'];
            $usuario->save();

            return redirect()->route('site.usuarios')->with(['message' => $message]);
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
        } else {
            $usuario->ativo = 1;
            $usuario->save();

            $message = [
                'type' => 'success',
                'text' => 'Usuário ativado com sucesso.'
            ];
        }

        return redirect()->route('site.usuarios')->with(['message' => $message]);
    }

    public function changePermission(Request $req, $id)
    {
        $data = $req->all();

        if ($data['type'] == 'add') {
            Permissao::create([
                'usuario_id' => $id,
                'cargo_id' => (int) $data['cargo_id'],
            ]);

            return response()->json(['status' => 'sucess', 'message' => 'Permissão adicionada com sucesso.']);
        } else if ($data['type'] == 'delete') {
            $permissao = Permissao::where('usuario_id', $id)->where('cargo_id', $data['cargo_id']);

            if ($permissao) {
                $permissao->delete();

                return response()->json(['status' => 'success', 'message' => 'Permissão removida com sucesso.']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro. 1']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ocorreu um erro. 2']);
        }
    }
}

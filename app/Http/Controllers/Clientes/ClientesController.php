<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Email;
use App\Models\Cliente\Endereco;
use App\Models\Cliente\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'asc')->get();
        
            
        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function view($id) {
        $cliente = Cliente::where('id', $id)->first();
        return view('clientes.view', ['cliente' => $cliente]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        if (Cliente::where('cpf', $data['cpf'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe um usuário cadastrado com este CPF.'
            ];

            return view('clientes.create', ['message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Cliente cadastrado com sucesso!'
            ];

            $cliente = Cliente::create([
                'nome_completo' => $data['nome'],
                'cpf' => $data['cpf'],
                'rg' => isset($data['rg']) ? $data['rg'] : '',
                'cadastrado_por' => Auth::user()->id,
            ]);

            Email::create([
                'cliente_id' => $cliente->id,
                'email' => $data['email'],
            ]);

            Endereco::create([
                'cliente_id' => $cliente->id,
                'cep' => $data['cep'],
                'logradouro' => $data['endereco'],
                'numero' => isset($data['numero']) ? $data['numero'] : '',
                'complemento' => isset($data['complemento']) ? $data['complemento'] : '',
                'bairro' => $data['bairro'],
                'cidade' => $data['cidade'],
                'uf' => $data['uf'],
            ]);

            Telefone::create([
                'cliente_id' => $cliente->id,
                'telefone' => $data['telefone'],
                'whatsapp' => (int) $data['whatsapp'],
            ]);

            $clientes = Cliente::orderBy('id', 'asc')->get();
            return view('clientes.index', ['clientes' => $clientes, 'message' => $message]);
        }
    }

    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)->first();

        return view('clientes.edit', ['cliente' => $cliente]);
    }
}

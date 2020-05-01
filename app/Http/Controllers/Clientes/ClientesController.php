<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\Email;
use App\Models\Cliente\Endereco;
use App\Models\Cliente\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'asc')->get();


        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function view($id)
    {
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

            return redirect()->route('site.clientes.create')->with(['message' => $message, 'data' => $data]);
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

            //TODO: email de cadastro de um cliente.
            // $to_name = $data['nome'];
            // $to_email = $data['email'];
            // $data = array('name' => env('APP_NAME'), 'body' => 'Você foi cadastrado no sistema!');

            // Mail::send('_layout.emails.emails', $data, function ($message) use ($to_name, $to_email) {
            //     $message->to($to_email, $to_name)->subject('Você foi cadastrado no sistema.');
            //     $message->from('contato@vitorvasconcellos.com.br', 'Test Mail');
            // });

            return redirect()->route('site.clientes')->with(['message' => $message]);
        }
    }

    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)->first();

        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function editValidate($id, Request $req)
    {
        $data = $req->all();

        switch ($data['form-type']) {
            case 'dados-pessoais':

                $cliente = Cliente::where('id', $id)->first();

                $cliente->nome_completo = $data['nome'];
                $cliente->rg = isset($data['rg']) ? $data['rg'] : '';

                $cliente->save();

                break;

            case 'enderecos':
                $endereco = Endereco::where('id', $data['endereco_id'])->first();

                $endereco->cep = $data['cep'];
                $endereco->logradouro = $data['endereco'];
                $endereco->numero = isset($data['numero']) ? $data['numero'] : '';
                $endereco->complemento = isset($data['complemento']) ? $data['complemento'] : '';
                $endereco->bairro = $data['bairro'];
                $endereco->cidade = $data['cidade'];
                $endereco->uf = $data['uf'];
                $endereco->save();

                break;

            case 'contatos':
                $telefone = Telefone::where('id', $data['telefone_id'])->first();

                $telefone->telefone = $data['telefone'];
                $telefone->whatsapp = (int) $data['whatsapp'];
                $telefone->save();

                $email = Email::where('id', $data['email_id'])->first();

                $email->email = $data['email'];
                $email->save();

                break;

            default:
                $message = [
                    'type' => 'error',
                    'text' => 'Ocorreu um erro. Por gentileza, informe o administrador do sistema.'
                ];

                return redirect()->route('site.clientes')->with(['message' => $message]);
                break;
        }

        $message = [
            'type' => 'success',
            'text' => 'Cliente alterado com sucesso!'
        ];

        return redirect()->route('site.clientes')->with(['message' => $message]);
    }
}

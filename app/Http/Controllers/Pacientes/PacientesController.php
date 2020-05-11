<?php

namespace App\Http\Controllers\Pacientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use App\Models\Especie;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::orderBy('id', 'asc')->get();

        return view('pacientes.index', ['pacientes' => $pacientes]);
    }

    public function create()
    {
        $especies = Especie::orderBy('id', 'asc')->get();
        $clientes = Cliente::orderBy('id', 'asc')->get();

        return view('pacientes.create', ['especies' => $especies, 'clientes' => $clientes]);
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        $cliente_cpf = explode(' | ', $data['proprietario'])[0];

        $cliente = Cliente::where('cpf', $cliente_cpf)->first();

        if (!$cliente) {
            $message = [
                'type' => 'error',
                'text' => 'Não foi possível encontrar este cliente cadastrado na base de dados.'
            ];

            return redirect()->route('site.pacientes.create')->with(['message' => $message, 'data' => $data]);
        } else {
            Paciente::create([
                'nome' => $data['nome'],
                'raca_id' => (int) $data['raca'],
                'cliente_id' => (int) $cliente->id,
                'cadastrado_por' => Auth::user()->id,
                'sexo' => $data['sexo'],
                'cor' => $data['cor'],
                'porte' => $data['porte'],
            ]);

            $message = [
                'type' => 'success',
                'text' => 'Paciente cadastrado com sucesso!'
            ];

            return redirect()->route('site.pacientes')->with(['message' => $message]);
        }
    }
}

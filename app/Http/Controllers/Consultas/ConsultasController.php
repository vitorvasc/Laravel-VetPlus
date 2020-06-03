<?php

namespace App\Http\Controllers\Consultas;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function create($id) {
        $paciente = Paciente::where('id', $id)->first();

        return view('consultas.create', ['paciente' => $paciente]);
    }

    public function insert($id, Request $req) {
        $data = $req->all();

        $funcionario_id = $req->user()->id;
        $date = now();
        $paciente_id = $id;

        Consulta::create([
            'data' => $date,
            'funcionario_id' => $funcionario_id,
            'paciente_id' => $paciente_id,
            'observacoes' => $data['observacoes'], 
        ]);

        $message = [
            'type' => 'success',
            'text' => 'Consulta cadastrada com sucesso!'
        ];

        return redirect()->route('site.pacientes.view', $id)->with(['message' => $message]);
    }

    public function view($id) {
        $consulta = Consulta::where('id', $id)->first();

        return view('consultas.view', ['consulta' => $consulta]);
    }
}

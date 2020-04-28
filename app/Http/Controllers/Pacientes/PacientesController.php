<?php

namespace App\Http\Controllers\Pacientes;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function index() {
        $pacientes = Paciente::orderBy('id', 'asc')->get();

        return view('pacientes.index', ['pacientes' => $pacientes]);
    }

    public function create() {
        $especies = Especie::orderBy('id', 'asc')->get();

        return view('pacientes.create', ['especies' => $especies]);
    }

    public function insert(Request $req) {
        return true;
    }
}

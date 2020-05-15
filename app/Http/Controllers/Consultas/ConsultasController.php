<?php

namespace App\Http\Controllers\Consultas;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    public function index() {
        $consultas = Consulta::orderBy('date', 'desc')->all();
        return view('consultas.index', ['consultas' => $consultas]);
    }
}

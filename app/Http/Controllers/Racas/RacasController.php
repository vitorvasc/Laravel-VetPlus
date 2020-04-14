<?php

namespace App\Http\Controllers\Racas;

use App\Http\Controllers\Controller;
use App\Models\Raca;
use Illuminate\Http\Request;

class RacasController extends Controller
{
    public function index() {
        $racas = Raca::orderBy('nome', 'asc')->get();

        return view('racas.index', ['racas' => $racas]);
    }
}

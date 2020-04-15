<?php

namespace App\Http\Controllers\Racas;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use App\Models\Raca;
use Illuminate\Http\Request;

class RacasController extends Controller
{
    public function index()
    {
        $racas = Raca::orderBy('nome', 'asc')->get();

        return view('racas.index', ['racas' => $racas]);
    }

    public function create()
    {
        $especies = Especie::orderBy('nome', 'asc')->get();

        return view('racas.create', ['especies' => $especies]);
    }

    public function insert(Request $req) {
        $data = $req->all();

        if(Raca::where('nome', $data['nome'])->where('especie_id', (int) $data['especie'])->first()) {
            $especies = Especie::orderBy('nome', 'asc')->get();

            $message = [
                'type' => 'error',
                'text' => 'Já existe uma raça com este nome para esta espécie.'
            ];

            return view('racas.create', ['especies' => $especies, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Raça cadastrada com sucesso!'
            ];

            Raca::create([
                'nome' => $data['nome'],
                'especie_id' => (int) $data['especie'],
            ]);
            
            $racas = Raca::orderBy('nome', 'asc')->get();

            return view('racas.index', ['racas' => $racas, 'message' => $message]);
        }
    }

    public function edit($id) {
        $raca = Raca::where('id', $id)->first();
        $especies = Especie::orderBy('nome', 'asc')->get();


        return view('racas.edit', ['raca' => $raca, 'especies' => $especies]);
    }

    public function editValidate(Request $req, $id) {
        $data = $req->all();
        $raca = Raca::where('id', $id)->first();

        if(Raca::where('nome', $data['nome'])->where('especie_id', $data['especie'])->first()) {
            $especies = Especie::orderBy('nome', 'asc')->get();

            $message = [
                'type' => 'error',
                'text' => 'Já existe uma raça com este nome para esta espécie.'
            ];

            return view('racas.edit', ['especies' => $especies, 'raca' => $raca, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Raça alterada com sucesso.'
            ];

            $raca->nome = $data['nome'];
            $raca->save();

            $racas = Raca::orderBy('nome', 'asc')->get();

            return view('racas.index', ['racas' => $racas, 'message' => $message]);
        }
    }
}

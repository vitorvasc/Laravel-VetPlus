<?php

namespace App\Http\Controllers\Especies;

use App\Http\Controllers\Controller;
use App\Models\Especie;
use Illuminate\Http\Request;

class EspeciesController extends Controller
{
    public function index()
    {
        $especies = Especie::orderBy('nome', 'asc')->get();
        return view('especies.index', ['especies' => $especies]);
    }

    public function create()
    {
        return view('especies.create');
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        if (Especie::where('nome', $data['nome'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe uma espécie com este nome.'
            ];

            return view('especies.create', ['message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Espécie cadastrada com sucesso!'
            ];

            Especie::create([
                'nome' => $data['nome'],
            ]);

            $especies = Especie::orderBy('nome', 'asc')->get();

            return view('especies.index', ['especies' => $especies, 'message' => $message]);
        }
    }

    public function edit($id)
    {
        $especie = Especie::where('id', $id)->first();

        return view('especies.edit', ['especie' => $especie]);
    }

    public function editValidate(Request $req, $id) {
        $data = $req->all();
        $especie = Especie::where('id', $id)->first();

        if(Especie::where('nome', $data['nome'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe uma espécie com este nome.'
            ];

            return view('especies.edit', ['especie' => $especie, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Espécie alterada com sucesso.'
            ];

            $especie->nome = $data['nome'];
            $especie->save();

            $especies = Especie::orderBy('nome', 'asc')->get();

            return view('especies.index', ['especies' => $especies, 'message' => $message]);
        }
    }
}

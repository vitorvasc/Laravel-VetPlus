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
        return view('administracao.especies.index', ['especies' => $especies]);
    }

    public function create()
    {
        return view('administracao.especies.create');
    }

    public function insert(Request $req)
    {
        $data = $req->all();

        if (Especie::where('nome', $data['nome'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe uma espécie com este nome.'
            ];

            return redirect()->route('site.especies.create')->with(['data' => $data, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Espécie cadastrada com sucesso!'
            ];

            Especie::create([
                'nome' => $data['nome'],
            ]);

            return redirect()->route('site.especies')->with(['message' => $message]);
        }
    }

    public function edit($id)
    {
        $especie = Especie::where('id', $id)->first();

        return view('administracao.especies.edit', ['especie' => $especie]);
    }

    public function editValidate(Request $req, $id) {
        $data = $req->all();
        $especie = Especie::where('id', $id)->first();

        if(Especie::where('nome', $data['nome'])->first()) {
            $message = [
                'type' => 'error',
                'text' => 'Já existe uma espécie com este nome.'
            ];

            return redirect()->route('site.especies.edit', $id)->with(['data' => $data, 'message' => $message]);
        } else {
            $message = [
                'type' => 'success',
                'text' => 'Espécie alterada com sucesso.'
            ];

            $especie->nome = $data['nome'];
            $especie->save();

            return redirect()->route('site.especies')->with(['message' => $message]);
        }
    }
}

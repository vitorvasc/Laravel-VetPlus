<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'asc')->get();
        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function insert(Request $req)
    {
        dd($req->all());
        return true;
    }

    public function edit($id)
    {
        return view('clientes.edit');
    }
}

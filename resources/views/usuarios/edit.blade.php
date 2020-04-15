@extends('_layout.site')

@section('titulo', 'Usuários - Alterar')

@section('conteudo')

<div class="row content list">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.usuarios.edit.validate', $usuario->id)}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
        <div class="row">
            <h5>Alterar usuário</h5>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input id="nome" name="nome" type="text" required class="validate" value="{{$usuario->nome_completo}}">
                <label for="nome">Nome completo</label>
            </div>
            <div class="input-field col s6">
                <input id="email" name="email" type="text" required class="validate" value="{{$usuario->email}}">
                <label for="email">E-mail</label>
            </div>
        </div>

        <div class="button">
            <a href="{{route('site.usuarios.changestatus', $usuario->id)}}" class="btn-small waves-effect waves-orange orange darken-1" type="submit">ativar / desativar
                usuário
            </a>
            <a class="btn-small waves-effect waves-red red darken-3" type="submit">enviar reset de senha
            </a>
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
            </button>
        </div>
    </form>
</div>


@endsection
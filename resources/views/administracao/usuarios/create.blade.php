@extends('_layout.site')

@section('titulo', 'Usuários - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.usuarios.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
        <div class="row">
            <h5>Adicionar novo usuário</h5>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input id="nome" name="nome" type="text" required class="validate" maxlength="64">
                <label for="nome">Nome completo</label>
            </div>
            <div class="input-field col s6">
                <input id="email" name="email" type="text" required class="validate" maxlength="128">
                <label for="email">E-mail</label>
            </div>
        </div>


        <div class="button">
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
            </button>
        </div>
    </form>
</div>

@endsection
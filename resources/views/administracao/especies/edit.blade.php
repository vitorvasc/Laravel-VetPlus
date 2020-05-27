@extends('_layout.site')

@section('titulo', 'Espécies - Alterar')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data"
        action="{{route('site.especies.edit.validate', $especie->id)}}">

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
        @endif

        {{ csrf_field() }}

        <div class="col s12">

            <div class="row">
                <h5>Alterar uma espécie</h5>
            </div>

            <div class="col s12 button">
                <a href="{{route('site.especies')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                        class="material-icons left tiny">arrow_back</i>voltar</a>
            </div>

            <div class="input-field col s12">
                <input id="nome" name="nome" type="text" required class="validate" @if(session('data'))
                    value="{{session('data')['nome']}}" @else value="{{$especie->nome}}" @endif maxlength="64">
                <label for="nome">Nome da espécie</label>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">salvar alterações
                </button>
            </div>
        </div>
    </form>
</div>


@endsection
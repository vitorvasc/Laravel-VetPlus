@extends('_layout.site')

@section('titulo', 'Espécies - Inserir')

@section('conteudo')

<div class="row content especies">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.especies.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
        <div class="row">
            <h5>Adicionar nova espécie</h5>
        </div>

        <div class="input-field col s12">
            <input id="nome" name="nome" type="text" required class="validate">
            <label for="nome">Nome da espécie</label>
        </div>

        <div class="button">
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
            </button>
        </div>
    </form>
</div>


@endsection
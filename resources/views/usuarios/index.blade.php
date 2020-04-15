@extends('_layout.site')

@section('titulo', 'Usuários')

@section('conteudo')

<div class="row content list">

    <div class="col s12 button">
        <a href="{{route('site.usuarios.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                class="material-icons right tiny">add_circle_outline</i>inserir espécie</a>
    </div>

    @if ($message ?? '')
    @include('_layout.error', ['message' => $message ?? ''])
    @endif

    <div class="col s12">
        <ul class="collection with-header">
            <li class="collection-header"><h5>Usuários</h5></li>
            @foreach ($usuarios as $usuario)
            <li class="collection-item">
                <div>(ID: {{$usuario->id}}) {{$usuario->nome_completo}}<a href="{{route('site.usuarios.edit', $usuario->id)}}"
                        class="secondary-content"><i class="material-icons">edit</i></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
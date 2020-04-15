@extends('_layout.site')

@section('titulo', 'Raças')

@section('conteudo')

<div class="row content especies">

    <div class="col s12 button">
        <a href="{{route('site.racas.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                class="material-icons right tiny">add_circle_outline</i>inserir raça</a>
    </div>

    @if ($message ?? '')
    @include('_layout.error', ['message' => $message ?? ''])
    @endif

    <div class="col s12">
        <ul class="collection with-header">
            <li class="collection-header"><h5>Raças</h5></li>
            @foreach ($racas as $raca)
            <li class="collection-item">
                <div>{{$raca->nome}} ({{$raca->especie->nome}})<a href="{{route('site.racas.edit', $raca->id)}}"
                        class="secondary-content"><i class="material-icons">edit</i></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
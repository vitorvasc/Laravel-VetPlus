@extends('_layout.site')

@section('titulo', 'Raças')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Raças</h5>

        <div class="col s12 button">
            <a href="{{route('site.racas.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                    class="material-icons right tiny">add_circle_outline</i>inserir raça</a>
        </div>

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        <table id="racas" class="centered striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($racas as $raca)
                <tr>
                    <td>{{$raca->nome}}</td>
                    <td>{{$raca->especie->nome}}</td>
                    <td><a href="{{route('site.racas.edit', $raca->id)}}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#racas').DataTable();
    });
</script>
@endpush



@endsection
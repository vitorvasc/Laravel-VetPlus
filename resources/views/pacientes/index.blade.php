@extends('_layout.site')

@section('titulo', 'Pacientes')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Pacientes</h5>

        <div class="col s12 button">
            <a href="{{route('site.pacientes.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                    class="material-icons right tiny">add_circle_outline</i>Novo paciente</a>
        </div>

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        <table id="pacientes" class="centered striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Cliente</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{$paciente->nome}}</td>
                    <td>{{$paciente->especie->nome}}</td>
                    <td>{{$paciente->raca->nome}}</td>
                    <td><a href="{{route('site.clientes.view', $paciente->cliente->id)}}"></a> {{$paciente->cliente->nome_completo}}</td>
                    <td>
                        <a href="{{route('site.pacientes.view', $paciente->id)}}"><i class="material-icons">person</i></a>
                        <a href="{{route('site.pacientes.edit', $paciente->id)}}"><i class="material-icons">edit</i></a>
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
        $('#pacientes').DataTable();
    });
</script>
@endpush


@endsection
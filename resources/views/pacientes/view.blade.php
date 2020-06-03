@extends('_layout.site')

@section('titulo', 'Pacientes - ' . $paciente->nome)

@section('conteudo')

<div class="row content list">

    @if (isset($message) || session('message'))
    @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
    @endif

    {{ csrf_field() }}
    <div class="col s12">
        <h5>Paciente: {{$paciente->nome}}</h5>
    </div>

    <div class="col s12 button">
        <a href="{{route('site.pacientes')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                class="material-icons left tiny">arrow_back</i>voltar</a>
    </div>


    <div class="row">
        <div class="col s12">
            <h6>Informações</h6>

            <div class="input-field col l4">
                <strong>Nome:</strong> {{$paciente->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Espécie:</strong> {{$paciente->raca->especie->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Raça:</strong> {{$paciente->raca->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Sexo:</strong> {{$paciente->sexo}}
            </div>

            <div class="input-field col l4">
                <strong>Porte:</strong> {{$paciente->porte}}
            </div>

            <div class="input-field col l4">
                <strong>Cor:</strong> {{$paciente->cor}}
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col s12">
            <h6>Consultas (últimas 10)</h6>
            <a href="{{route('site.consultas.create', $paciente->id)}}"
                class="btn-small waves-effect waves-blue light-blue darken-4 right"><i
                    class="material-icons left tiny">add</i>nova consulta</a>

            <table id="consultas" class="striped responsive-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Funcionário</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($paciente->consultas as $consulta)
                    <tr>
                        <td>{{$consulta->data}}</td>
                        <td>{{$consulta->funcionario->nome_completo}}</td>
                        <td><a href="{{route('site.consultas.view', $consulta->id)}}"><i
                                    class="material-icons">add</i></a></td>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $('.tabs').tabs();
    });
</script>
@endpush

@endsection
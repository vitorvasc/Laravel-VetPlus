@extends('_layout.site')

@section('titulo', 'Consultas - ' . $consulta->paciente->nome)

@section('conteudo')

<div class="row content list">

    @if (isset($message) || session('message'))
    @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
    @endif

    {{ csrf_field() }}
    <div class="col s12">
        <h5>Paciente: {{$consulta->paciente->nome}}</h5>
    </div>

    <div class="col s12 button">
        <a href="{{route('site.pacientes.view', $consulta->paciente->id)}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                class="material-icons left tiny">arrow_back</i>voltar</a>
    </div>


    <div class="row">
        <div class="col s12">
            <h6>Informações</h6>

            <div class="input-field col l4">
                <strong>Nome completo:</strong> {{$consulta->paciente->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Espécie:</strong> {{$consulta->paciente->raca->especie->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Raça:</strong> {{$consulta->paciente->raca->nome}}
            </div>

            <div class="input-field col l4">
                <strong>Sexo:</strong> {{$consulta->paciente->sexo}}
            </div>

            <div class="input-field col l4">
                <strong>Porte:</strong> {{$consulta->paciente->porte}}
            </div>

            <div class="input-field col l4">
                <strong>Cor:</strong> {{$consulta->paciente->cor}}
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col s12">
            <h6>Observações (últimas 10)</h6>
           
            <div class="input-field col s12">
                <textarea id="observacoes" name="observacoes" class="materialize-textarea" disabled maxlength="2048" data-length="2048">{{$consulta->observacoes}}</textarea>
                <label for="observacoes">Observações</label>
            </div>
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
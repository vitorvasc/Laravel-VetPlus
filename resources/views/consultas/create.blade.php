@extends('_layout.site')

@section('titulo', 'Pacientes - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data" action="{{route('site.consultas.insert', $paciente->id)}}">

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
        @endif

        {{ csrf_field() }}

        <div class="col s12">

            <div class="row">
                <h5>Nova consulta: {{$paciente->nome}}</h5>
            </div>

            <div class="col s12 button">
                <a href="{{route('site.pacientes.view', $paciente->id)}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
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

                <div class="col s12">
                    <h6>Observações da consulta</h6>

                    <div class="input-field col s12">
                        <textarea id="observacoes" name="observacoes" class="materialize-textarea" maxlength="2048" data-length="2048"></textarea>
                        <label for="observacoes">Observações</label>
                    </div>
                </div>


                <div class="button">
                    <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
                    </button>
                </div>

            </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('textarea').characterCounter();
    });
</script>
@endpush

@endsection
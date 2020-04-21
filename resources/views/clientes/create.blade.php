@extends('_layout.site')

@section('titulo', 'Clientes - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.clientes.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
        <div class="row">
            <h5>Cadastrar novo cliente</h5>
        </div>

        <div class="row">
            <h6>Dados pessoais</h6>

            <div class="input-field col l12">
                <input id="nome" name="nome" type="text" required class="validate">
                <label for="nome">Nome completo</label>
            </div>

            <div class="input-field col l6">
                <input id="cpf" name="cpf" type="text" required class="validate">
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col l6">
                <input id="rg" name="rg" type="text" required class="validate">
                <label for="rg">RG</label>
            </div>
        </div>

        <div class="row">
            <h6>Endereço</h6>

            <div class="input-field col l2">
                <input id="cep" name="cep" type="text" required class="validate">
                <label for="cep">CEP</label>
            </div>
            
            <div class="input-field col l6">
                <input id="endereco" name="endereco" type="text" required class="validate">
                <label for="endereco">Endereço</label>
            </div>

            <div class="input-field col l2">
                <input id="numero" name="numero" type="text" required class="validate">
                <label for="numero">Número</label>
            </div>
            <div class="input-field col l2">
                <input id="complemento" name="complemento" type="text" required class="validate">
                <label for="complemento">Complemento</label>
            </div>

            <div class="input-field col s3">
                <input id="bairro" name="bairro" type="text" required class="validate">
                <label for="bairro">Bairro</label>
            </div>
            <div class="input-field col l6">
                <input id="cidade" name="cidade" type="text" required class="validate">
                <label for="cidade">Cidade</label>
            </div>
            <div class="input-field col s3">
                <input id="uf" name="uf" type="text" required class="validate">
                <label for="uf">UF</label>
            </div>
        </div>

        <div class="row">
            <h6>Contatos</h6>

            <div class="input-field col l6">
                <input id="email" name="email" type="text" required class="validate">
                <label for="email">Email</label>
            </div>

            <div class="input-field col l6">
                <input id="telefone" name="telefone" type="text" required class="validate">
                <label for="telefone">Telefone</label>
            </div>
        </div>


        <div class="button">
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        
    });
</script>
@endpush

@endsection
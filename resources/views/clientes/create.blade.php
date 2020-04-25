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
                <input id="nome" name="nome" type="text" required class="validate" maxlength="128">
                <label for="nome">Nome completo</label>
            </div>

            <div class="input-field col l6">
                <input id="cpf" name="cpf" type="text" required class="validate" maxlength="14"> 
                <label for="cpf">CPF</label>
            </div>
            <div class="input-field col l6">
                <input id="rg" name="rg" type="text" required class="validate" maxlength="16">
                <label for="rg">RG</label>
            </div>
        </div>

        <div class="row">
            <h6>Endereço</h6>

            <div class="input-field col l2">
                <input id="cep" name="cep" type="text" required class="validate" maxlength="9">
                <label for="cep">CEP</label>
            </div>

            <div class="input-field col l6">
                <input id="endereco" name="endereco" type="text" required class="validate" maxlength="255">
                <label for="endereco">Endereço</label>
            </div>

            <div class="input-field col l2">
                <input id="numero" name="numero" type="text" required class="validate" maxlength="8">
                <label for="numero">Número</label>
            </div>
            <div class="input-field col l2">
                <input id="complemento" name="complemento" type="text" required class="validate" maxlength="16">
                <label for="complemento">Complemento</label>
            </div>

            <div class="input-field col s3">
                <input id="bairro" name="bairro" type="text" required class="validate" maxlength="255">
                <label for="bairro">Bairro</label>
            </div>
            <div class="input-field col l7">
                <input id="cidade" name="cidade" type="text" required class="validate" maxlength="255">
                <label for="cidade">Cidade</label>
            </div>
            <div class="input-field col s2">
                <input id="uf" name="uf" type="text" required class="validate" maxlength="2">
                <label for="uf">UF</label>
            </div>
        </div>

        <div class="row">
            <h6>Contatos</h6>

            <div class="input-field col l6">
                <input id="email" name="email" type="email" required class="validate" maxlength="128">
                <label for="email">Email</label>
            </div>

            <div class="input-field col l6">
                <input id="telefone" name="telefone" type="text" required class="validate" maxlength="16">
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
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00', {reverse: true});

        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        }, spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

        $('#telefone').mask(SPMaskBehavior, spOptions);

        var cepOptions = {
            onComplete: function(cep) {
                $('#endereco').prop("disabled", true);
                $('#bairro').prop("disabled", true);
                $('#cidade').prop("disabled", true);
                $('#uf').prop("disabled", true);
                
                $.ajax({
                    url: 'https://viacep.com.br/ws/'+ $('#cep').val() +'/json/',
                    dataType: 'jsonp',
                    success: function (response) {
                        $('#endereco').val(response.logradouro);
                        $('#bairro').val(response.bairro);
                        $('#cidade').val(response.localidade);
                        $('#uf').val(response.uf);
                        $('#numero').focus();
                        M.updateTextFields();
                    },
                    error: function (response) {
                        if(response.status == 404) {
                            M.toast({html: 'Oops! Este CEP não foi encontrado.'});
                        } else {
                            M.toast({html: 'Ocorreu um erro. Por gentileza, informe o administrador do sistema.'});
                        }
                    },
                }).then(function () {
                    $('#endereco').prop("disabled", false);
                    $('#bairro').prop("disabled", false);
                    $('#cidade').prop("disabled", false);
                    $('#uf').prop("disabled", false);
                });
            }
        }

        $('#cep').mask('00000-000', cepOptions);
    });
</script>
@endpush

@endsection
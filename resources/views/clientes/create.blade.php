@extends('_layout.site')

@section('titulo', 'Clientes - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data" action="{{route('site.clientes.insert')}}">

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
        @endif

        {{ csrf_field() }}

        <div class="col s12">

            <div class="row">
                <h5>Cadastrar novo cliente</h5>
            </div>

            <div class="col s12 button">
                <a href="{{route('site.clientes')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                        class="material-icons left tiny">arrow_back</i>voltar</a>
            </div>

            <div class="row">
                <h6>Dados pessoais</h6>

                <div class="input-field col l12">
                    <input id="nome" name="nome" type="text" required class="validate" maxlength="128"
                        @if(session('data')) value="{{session('data')['nome']}}" @endif>
                    <label for="nome">Nome completo *</label>
                </div>

                <div class="input-field col l6">
                    <input id="cpf" name="cpf" type="text" required class="validate" maxlength="14" @if(session('data'))
                        value="{{session('data')['cpf']}}" @endif>
                    <label for="cpf">CPF *</label>
                </div>
                <div class="input-field col l6">
                    <input id="rg" name="rg" type="text" class="validate" maxlength="16" @if(session('data'))
                        value="{{session('data')['rg']}}" @endif>
                    <label for="rg">RG</label>
                </div>
            </div>

            <div class="row">
                <h6>Endereço</h6>

                <div class="input-field col l2">
                    <input id="cep" name="cep" type="text" required class="validate" maxlength="9" @if(session('data'))
                        value="{{session('data')['cep']}}" @endif>
                    <label for="cep">CEP *</label>
                </div>

                <div class="input-field col l6">
                    <input id="endereco" name="endereco" type="text" required class="validate" maxlength="255"
                        @if(session('data')) value="{{session('data')['endereco']}}" @endif>
                    <label for="endereco">Endereço *</label>
                </div>

                <div class="input-field col l2">
                    <input id="numero" name="numero" type="text" required class="validate" maxlength="8"
                        @if(session('data')) value="{{session('data')['numero']}}" @endif>
                    <label for="numero">Número *</label>
                </div>
                <div class="input-field col l2">
                    <input id="complemento" name="complemento" type="text" class="validate" maxlength="16"
                        @if(session('data')) value="{{session('data')['complemento']}}" @endif>
                    <label for="complemento">Complemento</label>
                </div>

                <div class="input-field col s3">
                    <input id="bairro" name="bairro" type="text" required class="validate" maxlength="255"
                        @if(session('data')) value="{{session('data')['bairro']}}" @endif>
                    <label for="bairro">Bairro *</label>
                </div>
                <div class="input-field col l7">
                    <input id="cidade" name="cidade" type="text" required class="validate" maxlength="255"
                        @if(session('data')) value="{{session('data')['cidade']}}" @endif>
                    <label for="cidade">Cidade *</label>
                </div>
                <div class="input-field col s2">
                    <input id="uf" name="uf" type="text" required class="validate" maxlength="2" @if(session('data'))
                        value="{{session('data')['uf']}}" @endif>
                    <label for="uf">UF *</label>
                </div>
            </div>

            <div class="row">
                <h6>Contatos</h6>

                <div class="input-field col l6">
                    <input id="telefone" name="telefone" type="text" required class="validate" maxlength="16"
                        @if(session('data')) value="{{session('data')['telefone']}}" @endif>
                    <label for="telefone">Telefone *</label>
                </div>

                <div class="col l6" style="margin-top: 1rem; margin-bottom: 1rem;">
                    <p>
                        <label for="whatsapp">É WhatsApp?</label>
                        <label>
                            <input class="with-gap" id="whatsapp" name="whatsapp" type="radio" value="1"
                                @if(isset(session('data')['whatsapp']) && session('data')['whatsapp']==1) checked
                                @endif />
                            <span>Sim</span>
                        </label>
                        <label>
                            <input class="with-gap" id="whatsapp" name="whatsapp" type="radio" value="0"
                                @if(isset(session('data')['whatsapp']) && session('data')['whatsapp']==0) checked
                                @endif />
                            <span>Não</span>
                        </label>
                    </p>
                </div>

                <div class="input-field col l12">
                    <input id="email" name="email" type="email" required class="validate" maxlength="128"
                        @if(session('data')) value="{{session('data')['email']}}" @endif>
                    <label for="email">Email *</label>
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
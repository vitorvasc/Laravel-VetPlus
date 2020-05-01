@extends('_layout.site')

@section('titulo', 'Clientes - Alterar')

@section('conteudo')

<div class="row content list">
    @if (isset($message) || session('message'))
    @include('_layout.error', ['message' => isset($message) ? $message :  session('message')])
    @endif

    <div class="col s12">
        <h5>Alterar cliente: {{$cliente->nome_completo}}</h5>
    </div>

    <div class="col s12" style="margin: 15px 0 30px;">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#info">Dados pessoais</a></li>
            <li class="tab col s3"><a href="#enderecos">Endereços</a></li>
            <li class="tab col s3"><a href="#contatos">Contatos</a></li>
        </ul>
    </div>

    <div id="info" class="col s12">
        <form class="s12" method="POST" enctype="multipart/form-data"
            action="{{route('site.clientes.edit.validate', $cliente->id)}}">
            <h6>Dados pessoais</h6>

            {{ csrf_field() }}
            <input type="hidden" name="form-type" id="form-type" value="dados-pessoais">

            <div class="input-field col l12">
                <input id="nome" name="nome" type="text" required class="validate" maxlength="128"
                @if(session('data')['nome']) value="{{session('data')['nome']}}" @else value="{{$cliente->nome_completo}}" @endif>
                <label for="nome">Nome completo *</label>
            </div>

            <div class="input-field col l6">
                <input type="text" disabled class="validate" maxlength="14"
                @if(session('data')['cpf']) value="{{session('data')['cpf']}}" @else value="{{$cliente->cpf}}" @endif>
                <label for="cpf">CPF *</label>
            </div>
            <div class="input-field col l6">
                <input id="rg" name="rg" type="text" class="validate" maxlength="16"
                @if(session('data')['rg']) value="{{session('data')['rg']}}" @else value="{{$cliente->rg}}" @endif>
                <label for="rg">RG</label>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
                </button>
            </div>

        </form>
    </div>

    <div id="enderecos" class="col s12">
        <form class="s12" method="POST" enctype="multipart/form-data"
            action="{{route('site.clientes.edit.validate', $cliente->id)}}">
            <h6>Endereços</h6>

            {{ csrf_field() }}
            <input type="hidden" name="form-type" id="form-type" value="enderecos">

            @php
            $endereco = $cliente->enderecos[0];
            @endphp

            <input type="hidden" name="endereco_id" id="endereco_id" value="{{$endereco->id}}">

            <div class="input-field col l2">
                <input id="cep" name="cep" type="text" required class="validate" maxlength="9"
                @if(session('data')['cep']) value="{{session('data')['cep']}}" @else value="{{$endereco->cep}}" @endif">
                <label for="cep">CEP *</label>
            </div>

            <div class="input-field col l6">
                <input id="endereco" name="endereco" type="text" required class="validate" maxlength="255"
                @if(session('data')['endereco']) value="{{session('data')['endereco']}}" @else value="{{$endereco->logradouro}}" @endif">
                <label for="endereco">Endereço *</label>
            </div>

            <div class="input-field col l2">
                <input id="numero" name="numero" type="text" required class="validate" maxlength="8"
                @if(session('data')['numero']) value="{{session('data')['numero']}}" @else value="{{$endereco->numero}}" @endif">
                <label for="numero">Número *</label>
            </div>
            <div class="input-field col l2">
                <input id="complemento" name="complemento" type="text" class="validate" maxlength="16"
                @if(session('data')['complemento']) value="{{session('data')['complemento']}}" @else value="{{$endereco->complemento}}" @endif">
                <label for="complemento">Complemento</label>
            </div>

            <div class="input-field col s3">
                <input id="bairro" name="bairro" type="text" required class="validate" maxlength="255"
                @if(session('data')['bairro']) value="{{session('data')['bairro']}}" @else value="{{$endereco->bairro}}" @endif">
                <label for="bairro">Bairro *</label>
            </div>
            <div class="input-field col l7">
                <input id="cidade" name="cidade" type="text" required class="validate" maxlength="255"
                @if(session('data')['cidade']) value="{{session('data')['cidade']}}" @else value="{{$endereco->cidade}}" @endif">
                <label for="cidade">Cidade *</label>
            </div>
            <div class="input-field col s2">
                <input id="uf" name="uf" type="text" required class="validate" maxlength="2"
                @if(session('data')['uf']) value="{{session('data')['uf']}}" @else value="{{$endereco->uf}}" @endif">
                <label for="uf">UF *</label>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
                </button>
            </div>

        </form>
    </div>

    <div id="contatos" class="col s12">
        <form class="s12" method="POST" enctype="multipart/form-data"
            action="{{route('site.clientes.edit.validate', $cliente->id)}}">

            <h6>Contatos</h6>

            {{ csrf_field() }}
            <input type="hidden" name="form-type" id="form-type" value="contatos">

            @php
            $telefone = $cliente->telefones[0];
            $email = $cliente->emails[0];
            @endphp

            <input type="hidden" name="telefone_id" id="telefone_id" value="{{$telefone->id}}">
            <input type="hidden" name="email_id" id="email_id" value="{{$email->id}}">

            <div class="input-field col l6">
                <input id="telefone" name="telefone" type="text" required class="validate" maxlength="16"
                @if(session('data')['telefone']) value="{{session('data')['telefone']}}" @else value="{{$telefone->telefone}}" @endif">
                <label for="telefone">Telefone *</label>
            </div>

            <div class="col l6" style="margin-top: 1rem; margin-bottom: 1rem;">
                <p>
                    <label for="whatsapp">É WhatsApp?</label>
                    <label>
                        <input class="with-gap" id="whatsapp" name="whatsapp" type="radio" value="1"
                        @if($telefone->whatsapp) checked @endif />
                        <span>Sim</span>
                    </label>
                    <label>
                        <input class="with-gap" id="whatsapp" name="whatsapp" type="radio" value="0"
                        @if(!$telefone->whatsapp) checked @endif />
                        <span>Não</span>
                    </label>
                </p>
            </div>

            <div class="input-field col l12">
                <input id="email" name="email" type="email" required class="validate" maxlength="128"
                @if(session('data')['email']) value="{{session('data')['email']}}" @else value="{{$email->email}}" @endif">
                <label for="email">Email *</label>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
                </button>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.tabs').tabs();

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
                    M.updateTextFields();
                });
            }
        }

        $('#cep').mask('00000-000', cepOptions);
    });
</script>
@endpush

@endsection
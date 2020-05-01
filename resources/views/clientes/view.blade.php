@extends('_layout.site')

@section('titulo', 'Clientes - ' . $cliente->nome_completo)

@section('conteudo')

<div class="row content list">

    @if (isset($message) || session('message'))
    @include('_layout.error', ['message' => isset($message) ? $message :  session('message')])
    @endif

    {{ csrf_field() }}
    <div class="col s12">
        <h5>Cliente: {{$cliente->nome_completo}}</h5>
    </div>

    <div class="col s12" style="margin: 15px 0 30px;">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#info">Dados pessoais</a></li>
            <li class="tab col s3"><a href="#animais">Animais</a></li>
        </ul>
    </div>

    <div id="info" class="col s12">
        <div class="row">
            <div class="col s12">
                <h6>Dados pessoais</h6>

                <div class="input-field col l12">
                    <strong>Nome completo:</strong> {{$cliente->nome_completo}}
                </div>

                <div class="input-field col">
                    <strong>CPF:</strong> {{$cliente->cpf}}
                </div>
                @if ($cliente->rg != '')
                <div class="input-field col">
                    <strong>RG:</strong> {{$cliente->rg}}
                </div>
                @endif
            </div>
        </div>

        <div class="row">

            <div class="col s12">
                <h6>Endereços</h6>

                @foreach ($cliente->enderecos as $endereco)

                <div class="input-field col">
                    <strong>CEP:</strong> {{$endereco->cep}}
                </div>

                <div class="input-field col">
                    <strong>Logradouro:</strong> {{$endereco->logradouro}}
                </div>

                @if (isset($endereco->numero))
                <div class="input-field col">
                    <strong>Número:</strong> {{$endereco->numero}}
                </div>
                @endif

                @if ($endereco->complemento != '')
                <div class="input-field col">
                    <strong>Complemento:</strong> {{$endereco->complemento}}
                </div>
                @endif

                <div class="input-field col" style="clear: left;">
                    <strong>Bairro:</strong> {{$endereco->bairro}}
                </div>
                <div class="input-field col">
                    <strong>Cidade:</strong> {{$endereco->cidade}}
                </div>
                <div class="input-field col">
                    <strong>UF:</strong> {{$endereco->uf}}
                </div>

                <div class="input-field col" style="clear: left; display: flex;">
                    <i class="material-icons" style="margin-right: 5px;">map</i><a
                        href="https://www.google.com/maps/place/{{$endereco->logradouro}},+{{$endereco->numero}}+-+{{$endereco->bairro}},+{{$endereco->cidade}}+-+{{$endereco->uf}},+{{$endereco->cep}}"
                        target="_blank">Visualizar no Google Maps</a>
                </div>

                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <h6>Contatos</h6>

                @foreach ($cliente->telefones as $telefone)
                @if ($telefone->whatsapp)
                <div class="input-field col whatsapp">
                    <strong style="margin-right: 5px">Telefone:</strong>
                    @php
                    $characters = array(' ', '-', '(', ')');
                    $whatsapp = str_replace($characters, '', $cliente->whatsapp->telefone);
                    @endphp
                    <a href="https://api.whatsapp.com/send?phone=+55{{$whatsapp}}"
                        target="_blank">{{$cliente->whatsapp->telefone}}</a>
                </div>
                @else
    
                @endif
                @endforeach
    
                @foreach ($cliente->emails as $email)
                <div class="input-field col l12">
                    <strong>Email:</strong> {{$email->email}}
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="animais" class="col s12">
        <h6>Animais</h6>
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
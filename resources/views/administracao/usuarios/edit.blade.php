@extends('_layout.site')

@section('titulo', 'Usuários - Alterar')

@section('conteudo')

<div class="row content list">
    <div class="col s12 l10 push-l1">
        <h5>Alterar usuário</h5>
    </div>

    <div class="col s12 l10 push-l1" style="margin: 15px 0 30px;">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#info">Informações</a></li>
            <li class="tab col s3"><a href="#permission">Permissões</a></li>
        </ul>
    </div>

    <div id="info" class="col s12 l10 push-l1">
        <form method="POST" enctype="multipart/form-data"
            action="{{route('site.usuarios.edit.validate', $usuario->id)}}">

            @if ($message ?? '')
            @include('_layout.error', ['message' => $message ?? ''])
            @endif

            {{ csrf_field() }}

            <div class="row">
                <div class="input-field col s6">
                    <input id="nome" name="nome" type="text" required class="validate"
                        value="{{$usuario->nome_completo}}" maxlength="64">
                    <label for="nome">Nome completo</label>
                </div>
                <div class="input-field col s6">
                    <input id="email" name="email" type="text" required class="validate" value="{{$usuario->email}}" maxlength="128">
                    <label for="email">E-mail</label>
                </div>
            </div>

            <div class="row">

            </div>

            <div class="button">
                <a href="{{route('site.usuarios.edit.status', $usuario->id)}}"
                    class="btn-small waves-effect waves-orange orange darken-1" type="submit">ativar / desativar
                    usuário
                </a>
                <a class="btn-small waves-effect waves-red red darken-3" type="submit">enviar reset de senha
                </a>
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
                </button>
            </div>
        </form>
    </div>
    <div id="permission" class="col s12 l10 push-l1">
        <div class="chips chips-autocomplete"></div>
        <h6 style="font-style: italic; margin-top: 35px; font-size: .95rem">* As alterações realizadas são armazenadas automaticamente.</h6>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $('.tabs').tabs();

        $('.chips-autocomplete').chips({
            placeholder: 'Digite...',
            secondaryPlaceholder: 'Digite...',
            data: [
                @foreach($usuario->permissoes as $permissao)
                {
                    tag: "{{$permissao->cargo_id}} - {{$permissao->cargo->nome}}",
                },
                @endforeach
            ],
            autocompleteOptions: {
                data: {
                    @foreach($cargos as $cargo) 
                    "{{$cargo->id}} - {{$cargo->nome}}": null,
                    @endforeach
                },
                limit: Infinity,
                minLength: 1
            },
            onChipAdd: function(e, chip){
                var permissionID = chip.innerHTML.split('-')[0].trim();
                $.ajax({
                    type: 'POST',
                    url: '/usuarios/editar/{{$usuario->id}}/permissao',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "type": 'add',
                        "cargo_id": permissionID,
                    }
                });
            },
            onChipDelete: function(e, chip) {
                var permissionID = chip.innerHTML.split('-')[0].trim();
                $.ajax({
                    type: 'POST',
                    url: '/usuarios/editar/{{$usuario->id}}/permissao',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "type": 'delete',
                        "cargo_id": permissionID,
                    }
                });
            }
        });
    });
</script>
@endpush


@endsection
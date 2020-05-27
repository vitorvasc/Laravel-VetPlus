@extends('_layout.site')

@section('titulo', 'Usuários - Alterar')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Alterar usuário</h5>
    </div>

    <div class="col s12 button">
        <a href="{{route('site.usuarios')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                class="material-icons left tiny">arrow_back</i>voltar</a>
    </div>

    <div class="col s12" style="margin: 15px 0 30px;">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#info">Informações</a></li>
            <li class="tab col s3"><a href="#permission">Permissões</a></li>
        </ul>
    </div>

    <div id="info" class="col s12">
        <form method="POST" enctype="multipart/form-data"
            action="{{route('site.usuarios.edit.validate', $usuario->id)}}">

            @if (isset($message) || session('message'))
            @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
            @endif

            {{ csrf_field() }}

            <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nome" name="nome" type="text" required class="validate" @if(session('data'))
                            value="{{session('data')['nome']}}" @else value="{{$usuario->nome_completo}}" @endif
                            maxlength="64">
                        <label for="nome">Nome completo</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email" name="email" type="text" required class="validate" @if(session('data'))
                            value="{{session('data')['email']}}" @else value="{{$usuario->email}}" @endif
                            maxlength="128">
                        <label for="email">E-mail</label>
                    </div>
                </div>
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
    <div id="permission" class="col s12">
        <div class="col s12">
            <div class="chips chips-autocomplete"></div>
            <h6 style="font-style: italic; margin-top: 35px; font-size: .95rem">* As alterações realizadas são
                armazenadas automaticamente.</h6>
        </div>
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
                    },
                    success: function(res) {
                        M.toast({html: res.message});
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
                    },
                    success: function(res) {
                        M.toast({html: res.message});
                    }
                });
            }
        });
    });
</script>
@endpush


@endsection
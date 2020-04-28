@extends('_layout.site')

@section('titulo', 'Usuários')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Usuários</h5>

        <div class="col s12 button">
            <a href="{{route('site.usuarios.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                    class="material-icons right tiny">add_circle_outline</i>Novo usuário</a>
        </div>

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message :  session('message')])
        @endif

        <table id="usuarios" class="centered striped responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nome_completo}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->ativo ? 'Sim' : 'Não'}}</td>
                    <td><a href="{{route('site.usuarios.edit', $usuario->id)}}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#usuarios').DataTable();
    });
</script>
@endpush


@endsection
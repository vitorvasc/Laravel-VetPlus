@extends('_layout.site')

@section('titulo', 'Clientes')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Clientes</h5>

        <div class="col s12 button">
            <a href="{{route('site.clientes.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                    class="material-icons right tiny">add_circle_outline</i>Novo cliente</a>
        </div>

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        <table id="clientes" class="centered striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome_completo}}</td>
                    <td>{{$cliente->cpf}}</td>
                    <td>{{$cliente->email->email}}</td>
                    <td><a href="{{route('site.clientes.edit', $cliente->id)}}"><i class="material-icons">edit</i></a>
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
        $('#clientes').DataTable();
    });
</script>
@endpush


@endsection
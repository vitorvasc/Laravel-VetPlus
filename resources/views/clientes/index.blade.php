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

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message :  session('message')])
        @endif

        <table id="clientes" class="centered striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome_completo}}</td>
                    <td>{{$cliente->cpf}}</td>
                    @if (isset($cliente->whatsapp->telefone))
                    <td class="whatsapp">
                        @php
                            $characters = array(' ', '-', '(', ')');
                            $whatsapp = str_replace($characters, '', $cliente->whatsapp->telefone);
                        @endphp
                        <a href="https://api.whatsapp.com/send?phone=+55{{$whatsapp}}" target="_blank">{{$cliente->whatsapp->telefone}}</a>
                    </td>   
                    @else
                    <td>{{$cliente->telefones[0]->telefone}}</td>
                    @endif

                    <td>{{$cliente->emails[0]->email}}</td>
                    <td>
                        <a href="{{route('site.clientes.view', $cliente->id)}}"><i class="material-icons">person</i></a>
                        <a href="{{route('site.clientes.edit', $cliente->id)}}"><i class="material-icons">edit</i></a>
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
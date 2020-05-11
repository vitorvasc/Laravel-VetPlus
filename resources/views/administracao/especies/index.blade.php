@extends('_layout.site')

@section('titulo', 'Espécies')

@section('conteudo')

<div class="row content list">
    <div class="col s12">
        <h5>Espécies</h5>

        <div class="col s12 button">
            <a href="{{route('site.especies.create')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                    class="material-icons right tiny">add_circle_outline</i>inserir espécie</a>
        </div>
    
        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message :  session('message')])
        @endif
        
        <table id="especies" class="striped responsive-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($especies as $especie)
                <tr>
                    <td>{{$especie->nome}}</td>
                    <td><a href="{{route('site.especies.edit', $especie->id)}}" ><i
                                class="material-icons">edit</i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $('#especies').DataTable();
    });
</script>
@endpush


@endsection
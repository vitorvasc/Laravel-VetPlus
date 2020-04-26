@extends('_layout.site')

@section('titulo', 'Raças - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data" action="{{route('site.racas.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}

        <div class="col s12">
            <div class="row">
                <h5>Adicionar nova raça</h5>
            </div>

            <div class="input-field col s12">
                <select name="especie" id="especie" required>
                    <option value="" disabled selected>Escolha</option>
                    @foreach ($especies as $especie)
                    <option value="{{$especie->id}}">{{$especie->nome}}</option>
                    @endforeach
                </select>
                <label for="especie">Espécie</label>
            </div>

            <div class="input-field col s12">
                <input id="nome" name="nome" type="text" required class="validate" maxlength="64">
                <label for="nome">Nome da raça</label>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
            $('select').formSelect();
        });
</script>
@endpush

@endsection
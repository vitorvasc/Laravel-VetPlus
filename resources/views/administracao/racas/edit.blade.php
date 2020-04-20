@extends('_layout.site')

@section('titulo', 'Raças - Alterar')

@section('conteudo')

<div class="row content list">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.racas.edit.validate', $raca->id)}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
        <div class="row">
            <h5>Alterar uma raça</h5>
        </div>

        <div class="input-field col s12">
            <select name="especie" id="especie" required>
                <option value="" disabled selected>Escolha</option>
                @foreach ($especies as $especie)
                <option value="{{$especie->id}}" @if($especie->id == $raca->especie_id) selected @endif>{{$especie->nome}}</option>
                @endforeach
            </select>
            <label for="especie">Espécie</label>
        </div>

        <div class="input-field col s12">
            <input id="nome" name="nome" type="text" required class="validate" value="{{$raca->nome}}">
            <label for="nome">Nome da raça</label>
        </div>

        <div class="button">
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">salvar alterações
            </button>
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
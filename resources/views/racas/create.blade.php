@extends('_layout.site')

@section('titulo', 'Raças - Inserir')

@section('conteudo')

<div class="row content especies">
    <form class="col s12 l10 push-l1" method="POST" enctype="multipart/form-data"
        action="{{route('site.racas.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}
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
            <input id="nome" name="nome" type="text" required class="validate">
            <label for="nome">Nome da raça</label>
        </div>

        <div class="button">
            <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
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
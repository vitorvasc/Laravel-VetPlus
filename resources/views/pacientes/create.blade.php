@extends('_layout.site')

@section('titulo', 'Pacientes - Inserir')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data" action="{{route('site.pacientes.insert')}}">

        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        {{ csrf_field() }}

        <div class="col s12">

            <div class="row">
                <h5>Cadastrar novo paciente</h5>
            </div>

            <div class="row">
                <h6>Informações</h6>

                <div class="input-field col s12 l4">
                    <input id="nome" name="nome" type="text" required class="validate" maxlength="64">
                    <label for="nome">Nome *</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="especie" name="especie" id="especie" required>
                        <option value="" disabled selected>Escolha</option>
                        @foreach ($especies as $especie)
                        <option value="{{$especie->id}}">{{$especie->nome}}</option>
                        @endforeach
                    </select>
                    <label for="especie">Espécie</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="raca" name="raca" id="raca" required disabled>
                        <option value="" disabled selected>Escolha</option>
                    </select>
                    <label for="especie">Raça</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="sexo" name="sexo" id="sexo" required>
                        <option value="" disabled selected>Escolha</option>
                        <option value="F">Fêmea</option>
                        <option value="M">Macho</option>
                    </select>
                    <label for="especie">Sexo</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="porte" name="porte" id="porte" required>
                        <option value="" disabled selected>Escolha</option>
                        <option value="P">Pequeno</option>
                        <option value="M">Médio</option>
                        <option value="G">Grande</option>
                    </select>
                    <label for="especie">Porte</label>
                </div>

                <div class="input-field col s12 l4">
                    <input id="cor" name="cor" type="text" required class="validate" maxlength="32">
                    <label for="cor">Cor *</label>
                </div>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">criar
                </button>
            </div>

        </div>
    </form>
</div>

@push('scripts')
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('select.especie').formSelect();

        $('select.raca').formSelect();
        
        $('select.sexo').formSelect();

        $('select.porte').formSelect();


        $('select.especie').change(function () {
            $.ajax({
                    type: 'GET',
                    url: '/racas/listar-por-especie/' + $('select.especie option:selected').val(),
                    success: function(res) {

                        $('select.raca').empty().append('<option value="" disabled selected>Escolha</option>');

                        $.each(res, function(val, raca) {
                            $('select.raca').append(new Option(raca.nome, raca.id));
                            $('select.raca').prop('disabled', false);
                            $('select.raca').formSelect();
                        });
                    }
                });
        });
    });
</script>
@endpush

@endsection
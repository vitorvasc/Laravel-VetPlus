@extends('_layout.site')

@section('titulo', 'Pacientes - Alterar')

@section('conteudo')

<div class="row content list">
    <form class="col s12" method="POST" enctype="multipart/form-data"
        action="{{route('site.pacientes.edit.validate', $paciente->id)}}">

        @if (isset($message) || session('message'))
        @include('_layout.error', ['message' => isset($message) ? $message : session('message')])
        @endif

        {{ csrf_field() }}

        <div class="col s12">

            <div class="row">
                <h5>Alterar paciente: {{$paciente->nome}}</h5>
            </div>

            <div class="col s12 button">
                <a href="{{route('site.usuarios')}}" class="btn-small waves-effect waves-blue light-blue darken-4"><i
                        class="material-icons left tiny">arrow_back</i>voltar</a>
            </div>

            <div class="row">
                <h6>Informações</h6>

                <div class="input-field col s12 l4">
                    <input id="nome" name="nome" type="text" required class="validate" maxlength="64"
                        @if(isset(session('data')['nome'])) value="{{session('data')['nome']}}" @else
                        value="{{$paciente->nome}}" @endif>
                    <label for="nome">Nome *</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="especie" name="especie" id="especie" required>
                        <option value="" disabled selected>Escolha</option>
                        @if (isset(session('data')['especie']))
                        @foreach ($especies as $especie)

                        <option value="{{$especie->id}}" @if($especie->id == session('data')['especie']) selected
                            @endif>{{$especie->nome}}</option>
                        @endforeach

                        @else

                        @foreach ($especies as $especie)
                        <option value="{{$especie->id}}" @if($especie->id == $paciente->raca->especie->id) selected
                            @endif>{{$especie->nome}}</option>
                        @endforeach

                        @endif

                    </select>
                    <label for="especie">Espécie *</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="raca" name="raca" id="raca" required disabled>
                        <option value="" disabled selected>Escolha</option>
                    </select>
                    <label for="especie">Raça *</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="sexo" name="sexo" id="sexo" required>
                        <option value="" disabled selected>Escolha</option>
                        @if(isset(session('data')['sexo']))

                        <option value="F" @if(session('data')['sexo']=='F' ) selected @endif>Fêmea</option>
                        <option value="M" @if(session('data')['sexo']=='M' ) selected @endif>Macho</option>

                        @else

                        <option value="F" @if($paciente->sexo == 'F') selected @endif>Fêmea</option>
                        <option value="M" @if($paciente->sexo == 'M') selected @endif>Macho</option>

                        @endif
                    </select>
                    <label for="especie">Sexo *</label>
                </div>

                <div class="input-field col s12 l4">
                    <select class="porte" name="porte" id="porte" required>
                        <option value="" disabled selected>Escolha</option>
                        @if(isset(session('data')['porte']))
                        <option value="P" @if(session('data')['porte']=='P' ) selected @endif>Pequeno</option>
                        <option value="M" @if(session('data')['porte']=='M' ) selected @endif>Médio</option>
                        <option value="G" @if(session('data')['porte']=='G' ) selected @endif>Grande</option>

                        @else

                        <option value="P" @if($paciente->porte == 'P') selected @endif>Pequeno</option>
                        <option value="M" @if($paciente->porte == 'M') selected @endif>Médio</option>
                        <option value="G" @if($paciente->porte == 'G') selected @endif>Grande</option>

                        @endif
                    </select>
                    <label for="especie">Porte *</label>
                </div>

                <div class="input-field col s12 l4">
                    <input id="cor" name="cor" type="text" required class="validate" maxlength="32"
                        @if(isset(session('data')['cor'])) value="{{session('data')['cor']}}" @else
                        value="{{$paciente->cor}}" @endif>
                    <label for="cor">Cor *</label>
                </div>
            </div>

            <div class="row">
                <h6>Proprietário</h6>

                <div class="input-field col s12">
                    <input type="text" id="proprietario" name="proprietario" class="autocomplete"
                        value="{{$paciente->cliente->cpf}} | {{$paciente->cliente->nome_completo}}" disabled>
                    <label for="proprietario">Digite o CPF ou nome...</label>
                </div>
            </div>

            <div class="button">
                <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit">alterar
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

        $('input#proprietario').autocomplete({
            data: {
                @foreach($clientes as $cliente) 
                '{{$cliente->cpf}} | {{$cliente->nome_completo}}': null,
                @endforeach
            },
        });

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

        @if(isset(session('data')['especie']))
        $.ajax({
            type: 'GET',
            url: '/racas/listar-por-especie/' + $('select.especie option:selected').val(),
            success: function(res) {

                $('select.raca').empty().append('<option value="" disabled selected>Escolha</option>');

                console.log('Raça: {{$paciente->raca->nome}} {{$paciente->raca->id}}')

                $.each(res, function(val, raca) {
                    if({{session('data')['especie']}} == raca.id) {
                        $('select.raca').append('<option value="'+ raca.id +'" selected>'+ raca.nome +'</option>');
                    } else {
                        $('select.raca').append('<option value="'+ raca.id +'">'+ raca.nome +'</option>');
                    }

                    $('select.raca').formSelect();
                    $('select.raca').prop('disabled', false);
                });
            }
        });
        @elseif(isset($paciente->raca->especie->id) && !isset(session('data')['especie']))
        $.ajax({
            type: 'GET',
            url: '/racas/listar-por-especie/' + $('select.especie option:selected').val(),
            success: function(res) {

                $('select.raca').empty().append('<option value="" disabled selected>Escolha</option>');

                console.log('Raça: {{$paciente->raca->nome}} {{$paciente->raca->id}}')

                $.each(res, function(val, raca) {
                    if({{$paciente->raca->id}} == raca.id) {
                        $('select.raca').append('<option value="'+ raca.id +'" selected>'+ raca.nome +'</option>');
                    } else {
                        $('select.raca').append('<option value="'+ raca.id +'">'+ raca.nome +'</option>');
                    }

                    $('select.raca').formSelect();
                    $('select.raca').prop('disabled', false);
                });
            }
        });
        @endif
    });
</script>
@endpush

@endsection
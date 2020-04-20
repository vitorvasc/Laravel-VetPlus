@extends('_layout.site')

@section('titulo', 'Login')

@section('conteudo')

<div class="row login col s12 l6 push-l3">
    <div class="col s12 l6 push-l3">
        <div class="row box-title">
            <h3>{{@env('APP_NAME')}}</h3>
        </div>
        @if ($message ?? '')
        @include('_layout.error', ['message' => $message ?? ''])
        @endif

        <div class="row form-login">
            <form action="{{route('site.login.validate')}}" method="post" class="col s10 push-s1"
                enctype="multipart/formdata">
                {{ csrf_field() }}
                <input name="hidden" type="text" style="display:none;">
                <div class="input-field">
                    <input type="email" required name="email">
                    <label for="email">E-mail</label>
                </div>
                <div class="input-field">
                    <input type="password" required name="password">
                    <label for="password">Senha</label>
                </div>
                <div class="row">
                    <button class="btn-small waves-effect waves-blue light-blue darken-4" type="submit"
                        name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
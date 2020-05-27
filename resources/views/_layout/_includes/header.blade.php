<!DOCTYPE html>
<html>

<head>
    <title>{{@env('APP_NAME')}} - @yield('titulo')</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name=”description”
        content=" Diga adeus às planilhas. VetPlus é um sistema voltado para a gestão de clínicas veterinárias.">
</head>

<body>
    <header>
        @if (Auth::user())

        @if (Auth::user()->isAdmin())
        <ul id="dropdown-admin" class="dropdown-content">
            <li @if(Route::current()->getName() == 'site.especies') class="active" @endif>
                <a href="{{route('site.especies')}}">Espécies</a>
            </li>
            <li @if(Route::current()->getName() == 'site.racas') class="active" @endif>
                <a href="{{route('site.racas')}}">Raças</a>
            </li>
            <li @if(Route::current()->getName() == 'site.usuarios') class="active" @endif>
                <a href="{{route('site.usuarios')}}">Usuários</a>
            </li>
            {{-- <li class="divider"></li>
            <li><a href="#!">three</a></li> --}}
        </ul>
        @endif
        <nav>
            <div class="nav-wrapper">
                <a href="{{route('site.login')}}" class="brand-logo">{{@env('APP_NAME')}} </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li @if(Route::current()->getName() == 'site.home') class="active" @endif>
                        <a href="{{route('site.home')}}">Início</a>
                    </li>

                    <li @if(Route::current()->getName() == 'site.clientes') class="active" @endif>
                        <a href="{{route('site.clientes')}}">Clientes</a>
                    </li>

                    <li @if(Route::current()->getName() == 'site.pacientes') class="active" @endif>
                        <a href="{{route('site.pacientes')}}">Pacientes</a>
                    </li>

                    @if (@Auth::user()->isAdmin())
                    <li>
                        <a class="dropdown-trigger dd-administracao" href="#!" data-target="dropdown-admin">Administração<i
                                class="material-icons right">arrow_drop_down</i></a>
                    </li>
                    @endif

                    <li @if(Route::current()->getName() == 'site.logout') class="active" @endif>
                        <a href="{{route('site.logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <div class="divider"></div>

            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Início</a>
            </li>

            <li @if(Route::current()->getName() == 'site.clientes') class="active" @endif>
                <a href="{{route('site.clientes')}}">Clientes</a>
            </li>

            <li @if(Route::current()->getName() == 'site.pacientes') class="active" @endif>
                <a href="{{route('site.pacientes')}}">Pacientes</a>
            </li>

            @if (@Auth::user()->isAdmin())
            <div class="divider"></div>

            <li @if(Route::current()->getName() == 'site.especies') class="active" @endif>
                <a href="{{route('site.especies')}}">Espécies</a>
            </li>
            <li @if(Route::current()->getName() == 'site.racas') class="active" @endif>
                <a href="{{route('site.racas')}}">Raças</a>
            </li>
            <li @if(Route::current()->getName() == 'site.usuarios') class="active" @endif>
                <a href="{{route('site.usuarios')}}">Usuários</a>
            </li>

            <div class="divider"></div>
            @endif


            {{-- @if (@Auth::user()->isAdmin())
            <div class="divider"></div>
            <li>
                <a href="#">Administração</a>
            </li>
            <div class="divider"></div>
            @endif --}}

            <li @if(Route::current()->getName() == 'site.logout') class="active" @endif>
                <a href="{{route('site.logout')}}">Logout</a>
            </li>
        </ul>

        @if (Auth::user()->isAdmin())
        @push('scripts')
        <script>
            $(document).ready(function(){
                $(".dropdown-trigger").dropdown();
            });
        </script>
        @endpush
        @endif

        @push('scripts')
        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script>
        @endpush
        @endif
    </header>
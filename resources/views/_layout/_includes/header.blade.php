<!DOCTYPE html>
<html>

<head>
    <title>{{@env('APP_NAME')}} - @yield('titulo')</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header>
        @if (Auth::user())            
        <nav>
            <div class="nav-wrapper">
                <a href="{{route('site.login')}}" class="brand-logo">{{@env('APP_NAME')}} </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                        <a href="{{route('site.login')}}">Início</a>
                    </li>
                    <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                        <a href="{{route('site.login')}}">Notícias</a>
                    </li>
                    <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                        <a href="{{route('site.login')}}">Equipe</a>
                    </li>
                    <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                        <a href="{{route('site.login')}}">Fórum</a>
                    </li>
                    @if(Auth::guest())
                    <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                        <a href="{{route('site.login')}}">Login</a>
                    </li>
                    @else
                    <li @if(Route::current()->getName() == 'ucp.logout') class="active" @endif>
                        <a href="{{route('ucp.logout')}}">Logout ({{Auth::user()->Name}})</a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-demo">
            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Início</a>
            </li>
            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Notícias</a>
            </li>
            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Equipe</a>
            </li>

            @if (Auth::user())
            <div class="divider"></div>
            <li @if(Route::current()->getName() == 'ucp.characters') class="active" @endif>
                <a href="{{ route('ucp.characters') }}">Meus Personagens</a>
            </li>
            <li @if(Route::current()->getName() == 'ucp.characters.create') class="active" @endif>
                <a href="{{ route('ucp.characters.create') }}">Criar Personagem</a>
            </li>
            @if (@Auth::user()->isAdmin())
            <div class="divider"></div>
            <li>
                <a href="#">Administração</a>
            </li>
            @endif
            <div class="divider"></div>
            @endif

            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Fórum</a>
            </li>
            @if(Auth::guest())
            <li @if(Route::current()->getName() == 'site.login') class="active" @endif>
                <a href="{{route('site.login')}}">Login</a>
            </li>
            @else
            <li @if(Route::current()->getName() == 'ucp.logout') class="active" @endif>
                <a href="{{route('ucp.logout')}}">Logout ({{Auth::user()->Name}})</a>
            </li>
            @endif
        </ul>

        @push('scripts')
        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script>
        @endpush
        @endif
    </header>
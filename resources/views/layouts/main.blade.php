<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('../resources/media/favicon.png') }}">
    @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
    <title>@yield('titulo')</title>
</head>
<body>
    @if (Auth::check())
        <meta name="userId" content="{{ Auth::user()->id }}">
    @endif
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img id="logo" src="{{ url("../resources/media/logo.jfif") }}" width="30" height="30" alt="">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Auth::check())
                    @if (Auth::user()->rol->tipus == 'Administrador')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="desplegable" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dades mestres
                            </a>
                            <ul class="dropdown-menu">
                                @yield('menuMestres') 
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->rol->tipus == 'Professor')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="desplegable" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Professors
                            </a>
                            <ul class="dropdown-menu">
                                @yield('menuProfes')
                            </ul>
                        </li>
                    @endif
                    @if (Auth::user()->rol->tipus == 'Alumne')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="desplegable" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Alumnes
                            </a>
                            <ul class="dropdown-menu">
                                @yield('menuAlumnes')
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
              @if (Auth::check())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->nom }}
                  </a>
                  <ul class="dropdown-menu">
                    <a class="nav-link" href="{{ url('/logout') }}" aria-expanded="false">
                      Logout
                  </a>
                    </ul>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/login') }}" aria-expanded="false">
                      Login
                  </a>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">
            @yield('contingut')
      </div>

</body>
</html>

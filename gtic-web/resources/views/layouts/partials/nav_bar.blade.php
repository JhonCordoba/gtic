<nav class="navbar borde-barra-horizontal header-top navbar-expand-lg fixed-top navbar-dark bg-dark">
    <span class="navbar-toggler-icon leftmenutrigger"></span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a style="color: white;" class="navbar-brand" href="{{ url('/') }}">
        Sistema de Gestión Tecnológica
    </a>

    <div class="collapse navbar-collapse" id="navbarText">
        <ul id="listaDeFuncionesMenuPrincipal" style="background-color: #272727c7 !important; " class="navbar-nav animate side-nav open">

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href = '/#/';">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> home </i>
                    <a style="margin-top: 0.4em;" class="nav-link">Inicio</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/tareas'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> assignment </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Tareas</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/software'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> memory </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Software</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/movimientos'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> sync </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Movimientos</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/recursoshumanos'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> supervisor_account </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Personal</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/inventario'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> adb </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Inventario</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar" onclick="window.location.href='/#/configuracion'">
                <div style="font-size: 1.1em;">
                    <i class="material-icons float-right" style="color: white; margin-top: 0.4em;"> settings </i>
                    <a onclick="event.preventDefault();" style="margin-top: 0.4em;" class="nav-link">Configuración</a>
                </div>
            </li>

            <li class="nav-item borde-elemento-navbar">
                <div style="font-size: 1.1em;">

                    <i onclick="document.getElementById('logout-form').submit();" class="material-icons float-right" style="color: white; margin-top: 0.4em;"> exit_to_app </i>
                    <a style="margin-top: 0.4em;" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

            <li id="logo_menu_vertical"> <img style="width: 100%; margin-top: 40%;" src="/svg/logo.jpg" /> </li>

        </ul>

    </div>

    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
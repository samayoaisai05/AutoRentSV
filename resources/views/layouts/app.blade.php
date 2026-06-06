<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AutoRent SV')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --primary: #0F172A;
            --secondary: #1E3A5F;
            --accent: #F97316;
            --accent-hover: #EA580C;
            --light: #F8FAFC;
            --gray: #E5E7EB;
            --text: #374151;
            --white: #FFFFFF;
        }

        body{
            background-color: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar{
            background-color: var(--primary);
        }

        .navbar-brand,
        .nav-link{
            color: var(--white) !important;
        }

        .nav-link:hover{
            color: var(--accent) !important;
        }

        .user-name{
            color: #cbd5e1 !important;
        }

        footer{
            background-color: var(--primary);
            color: white;
            margin-top: auto;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        <a class="navbar-brand fw-bold"
           href="{{ route('home') }}">
            🚗 AutoRent SV
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                {{-- Catálogo visible para todos --}}
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('catalogo.index') }}">
                        Catálogo
                    </a>
                </li>

                @auth

                    {{-- Dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    {{-- Menú del administrador --}}
                    @if(Auth::user()->is_admin)

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('vehiculos.index') }}">
                                Vehículos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('clientes.index') }}">
                                Clientes
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('admin.reservas.index') }}">
                                Reservas
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('reportes.index') }}">
                                Reportes
                            </a>
                        </li>

                    @else

                        {{-- Menú del cliente --}}
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('reservas.mis') }}">
                                Mis Reservas
                            </a>
                        </li>

                    @endif

                    {{-- Nombre del usuario --}}
                    <li class="nav-item">
                        <span class="nav-link user-name">
                            {{ Auth::user()->name }}
                        </span>
                    </li>

                    {{-- Cerrar sesión --}}
                    <li class="nav-item">

                        <form action="{{ route('logout') }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="btn btn-link nav-link text-decoration-none">
                                Cerrar Sesión
                            </button>

                        </form>

                    </li>

                @else

                    {{-- Invitados --}}
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('login') }}">
                            Iniciar Sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('register') }}">
                            Registrarse
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="text-center">
    © {{ date('Y') }} AutoRent SV | Sistema de Alquiler de Vehículos
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
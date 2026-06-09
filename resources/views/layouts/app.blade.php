<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'AutoRent SV')</title>

    <!-- Agrega el favicon desde la carpeta public -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --primary: #0F172A;
            --accent: #F97316;
            --light: #F8FAFC;
            --white: #FFFFFF;
        }

        body{
            background-color: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar{
            background-color: var(--primary);
            padding: 10px 0;
        }

        .navbar-brand{
            color: var(--white) !important;
        }

        .nav-link{
            color: var(--white) !important;
            transition: 0.2s;
        }

        .nav-link:hover{
            color: var(--accent) !important;
        }

        /* DROPDOWN */
        .dropdown-menu{
            border-radius: 12px;
            border: none;
            overflow: hidden;
        }

        .dropdown-item:hover{
            background-color: var(--accent);
            color: white;
        }

        footer{
            background-color: var(--primary);
            color: white;
            margin-top: auto;
            padding: 15px 0;
        }

        /* LOGO */
        .navbar-brand img{
            transition: 0.3s ease;
        }

        .navbar-brand img:hover{
            transform: scale(1.05);
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center gap-1" href="{{ route('home') }}">

            <img src="{{ asset('img/logo.png') }}"
                 alt="AutoRent SV"
                 width="55"
                 height="55"
                 style="object-fit: contain;">

            <span class="fw-bold fs-4">
                AutoRent SV
            </span>

        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                {{-- CATÁLOGO --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalogo.index') }}">
                        Catálogo
                    </a>
                </li>

                @auth

                    {{-- ADMIN --}}
                    @if(Auth::user()->is_admin)

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vehiculos.index') }}">
                                Vehículos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clientes.index') }}">
                                Clientes
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.reservas.index') }}">
                                Reservas
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportes.index') }}">
                                Reportes
                            </a>
                        </li>

                    @else

                        {{-- CLIENTE --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservas.mis') }}">
                                Mis Reservas
                            </a>
                        </li>

                    @endif

                    {{-- USER DROPDOWN --}}
                    <li class="nav-item dropdown ms-3">

                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                 width="32"
                                 height="32"
                                 class="rounded-circle border border-2 border-light">

                            <div class="d-flex flex-column text-start">
                                <span class="fw-semibold text-white">
                                    {{ Auth::user()->name }}
                                </span>

                                <small class="text-warning" style="font-size: 11px;">
                                    {{ Auth::user()->is_admin ? 'Administrador' : 'Cliente' }}
                                </small>
                            </div>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li>
                                <a class="dropdown-item fw-semibold" href="{{ route('dashboard') }}">
                                    📊 Panel de control
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.perfil') }}">
                                    👤 Mi Perfil
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        🚪 Cerrar sesión
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </li>

                @else

                    {{-- GUEST --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Iniciar Sesión
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Registrarse
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>
</nav>

{{-- CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="text-center">
    © {{ date('Y') }} AutoRent SV | Sistema de Alquiler de Vehículos
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Éxito',
    text: "{{ session('success') }}",
    confirmButtonColor: '#F97316'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}",
    confirmButtonColor: '#dc3545'
});
</script>
@endif

@if(session('warning'))
<script>
Swal.fire({
    icon: 'warning',
    title: 'Advertencia',
    text: "{{ session('warning') }}",
    confirmButtonColor: '#ffc107'
});
</script>
@endif

@if(session('info'))
<script>
Swal.fire({
    icon: 'info',
    title: 'Información',
    text: "{{ session('info') }}",
    confirmButtonColor: '#0dcaf0'
});
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Perfil actualizado',
    text: '{{ session("success") }}',
    confirmButtonColor: '#F97316'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session("error") }}',
    confirmButtonColor: '#dc3545'
});
</script>
@endif

</body>
</html>

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
            color: var(--text);
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

        .btn-primary-custom{
            background-color: var(--accent);
            border: none;
            color: white;
        }

        .btn-primary-custom:hover{
            background-color: var(--accent-hover);
        }

        main{
            flex: 1;
        }

        footer{
            background-color: var(--primary);
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="/">
    
    <img src="{{ asset('img/logo.png') }}"
         alt="AutoRent SV"
         width="50"
         height="50"
         class="me-2">

    <span class="fw-bold">
        AutoRent SV
    </span>

</a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catalogo.index') }}">
                            Catálogo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Registro
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <main>

        <div class="container mt-4">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

        </div>

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} AutoRent SV - Sistema de Alquiler de Vehículos
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
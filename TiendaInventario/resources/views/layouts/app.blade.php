<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="utf-t">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Tienda de Inventario')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0a0a0f;
            color: #e0e0e0;
        }
        .navbar {
            background-color: rgba(20, 20, 30, 0.8);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid #334;
        }
        .table {
            --bs-table-bg: #1a1a2e;
            --bs-table-striped-bg: #2a2a3e;
            --bs-table-hover-bg: #3a3a4e;
            border-color: #334;
        }
        .card {
            background-color: #1a1a2e;
            border: 1px solid #334;
        }
        .form-control, .form-select {
            background-color: #2a2a3e;
            border: 1px solid #445;
            color: #fff;
        }
        .form-control:focus {
            background-color: #2a2a3e;
            border-color: #0d6efd;
            color: #fff;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-outline-info {
            color: #0dcaf0;
            border-color: #0dcaf0;
        }
        .btn-outline-info:hover {
            background-color: #0dcaf0;
            color: #000;
        }
        /* Icono de Tecnología */
        .navbar-brand::before {
            content: "💻";
            margin-right: 8px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('productos.index') }}">Inventario Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('productos.create') }}">Registrar Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="text-center text-muted py-4 mt-5 border-top border-dark-subtle">
        Sistema de Inventario &copy; {{ date('Y') }}
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>

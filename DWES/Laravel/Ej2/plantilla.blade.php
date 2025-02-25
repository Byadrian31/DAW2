<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="mb-4">
            <h1>@yield('titulo')</h1>
            @include('partials.nav')
        </header>
        
        <main>
            @yield('contenido')
        </main>
        
        <footer class="mt-5 text-center">
            <p>Proyecto Blog Laravel - {{ date('Y') }}</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

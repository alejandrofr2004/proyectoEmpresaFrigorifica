<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso denegado</title>
    <link rel="stylesheet" href="{{ asset('css/403.css') }}">
</head>
<body>
<div class="error-container">
    <img src="{{ asset('img/logo.png') }}" alt="Error 403" class="error-image">
    <h1 class="error-code">403</h1>
    <h2 class="error-message">Acceso denegado</h2>
    <p class="error-description">No tienes permiso para acceder a esta página.</p>
    <a href="{{ url('/') }}" class="home-button">Volver al inicio</a>
</div>
</body>
</html>

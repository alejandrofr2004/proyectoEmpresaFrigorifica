<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="{{ asset('css/404.css') }}">
</head>
<body>
<div class="error-container">
    <img src="{{ asset('img/logo.png') }}" alt="Error 404" class="error-image">
    <h1 class="error-code">404</h1>
    <h2 class="error-message">Página no encontrada</h2>
    <p class="error-description">Lo sentimos, la página que buscas no está disponible.</p>
    <a href="{{ url('/') }}" class="home-button">Volver al inicio</a>
</div>
</body>
</html>

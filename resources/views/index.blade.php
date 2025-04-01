<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo empresa frigorífica</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header class="header">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo de FríoMarket">
    </div>
    <nav class="menu">
        <ul class="menu-links">
            <li class="menu-item">
                <a href="#pescados">Pescados</a>
                <img src="{{ asset('img/pescado.png') }}" alt="Imagen de Pescados" class="menu-image">
                <ul class="submenu">
                    <li><a href="#atun">Atún</a></li>
                    <li><a href="#merluza">Merluza</a></li>
                    <li><a href="#sardinas">Sardinas</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="#cefalopodos">Cefalópodos</a>
                <img src="{{ asset('img/calamar.png') }}" alt="Imagen de Cefalópodos" class="menu-image">
                <ul class="submenu">
                    <li><a href="#pulpo">Pulpo</a></li>
                    <li><a href="#calamar">Calamar</a></li>
                    <li><a href="#sepia">Sepia</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="#mariscos">Mariscos</a>
                <img src="{{ asset('img/camaron.png') }}" alt="Imagen de Mariscos" class="menu-image">
                <ul class="submenu">
                    <li><a href="#camaron">Camarón</a></li>
                    <li><a href="#ostras">Ostras</a></li>
                    <li><a href="#mejillones">Mejillones</a></li>
                </ul>
            </li>
        </ul>
        <div class="auth-buttons">
            <button class="login">Iniciar sesión</button>
            <button class="register">Registrarse</button>
        </div>
    </nav>
</header>
<div class="extra-sections">
    <nav class="menu">
        <ul class="menu-links">
            <li><a href="#carnes">Carnes</a></li>
            <li><a href="#verduras">Verduras</a></li>
            <li><a href="#precocinados">Precocinados</a></li>
            <li><a href="#conservas">Conservas</a></li>
        </ul>
    </nav>
    <div class="cart-container-wrapper">
        <span class="products-counter">Productos cesta: 0</span>
        <div class="cart-container">
            <img src="{{ asset('img/carrito.png') }}" alt="Carrito de compras" class="cart-icon">
        </div>
    </div>
</div>
<div class="image-block">
    <img src="{{ asset('img/tienda.jpg') }}" alt="Imagen destacada de FríoMarket" class="featured-image">
</div>
<h1 class="section-title">Productos más vendidos</h1>
<div class="products-section">
    <div class="products-grid">
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 1" class="product-image">
            <h3 class="product-title">Producto 1</h3>
            <p class="product-price">€10.99</p>
        </div>
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 2" class="product-image">
            <h3 class="product-title">Producto 2</h3>
            <p class="product-price">€12.50</p>
        </div>
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 3" class="product-image">
            <h3 class="product-title">Producto 3</h3>
            <p class="product-price">€8.75</p>
        </div>
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 4" class="product-image">
            <h3 class="product-title">Producto 4</h3>
            <p class="product-price">€11.20</p>
        </div>
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 5" class="product-image">
            <h3 class="product-title">Producto 5</h3>
            <p class="product-price">€9.80</p>
        </div>
        <div class="product-card">
            <img src="tienda.jpg" alt="Producto 6" class="product-image">
            <h3 class="product-title">Producto 6</h3>
            <p class="product-price">€13.45</p>
        </div>
    </div>
</div>
</body>
</html>

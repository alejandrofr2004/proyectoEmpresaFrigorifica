<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo Empresa Frigorífica</title>
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
<h1 class="section-title">Bienvenido a la web de Frío Market</h1>
<div class="image-block">
    <img src="{{ asset('img/tienda.jpg') }}" alt="Imagen destacada de FríoMarket" class="featured-image">
</div>
<h1 class="section-title">Productos más vendidos</h1>
<div class="products-section">
    <div class="products-grid">
        <div class="product-card">
            <img src="{{ asset('img/atun.jpg') }}" alt="Imagen atún" class="product-image">
            <h3 class="product-title">Atún</h3>
            <p class="product-price">€10.99/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
        <div class="product-card">
            <img src="{{ asset('img/pulpo.jpg') }}" alt="Imagen pulpo" class="product-image">
            <h3 class="product-title">Pulpo</h3>
            <p class="product-price">€12.50/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
        <div class="product-card">
            <img src="{{ asset('img/merluza.jpg') }}" alt="Imagen merluza" class="product-image">
            <h3 class="product-title">Merluza</h3>
            <p class="product-price">€8.75/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
        <div class="product-card">
            <img src="{{ asset('img/calamarFresco.jpg') }}" alt="Imagen calamar" class="product-image">
            <h3 class="product-title">Calamar</h3>
            <p class="product-price">€11.20/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
        <div class="product-card">
            <img src="{{ asset('img/camaronFresco.jpg') }}" alt="Imagen camarón" class="product-image">
            <h3 class="product-title">Camarón</h3>
            <p class="product-price">€9.80/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
        <div class="product-card">
            <img src="{{ asset('img/mejillon.jpg') }}" alt="Imagen mejillones" class="product-image">
            <h3 class="product-title">Mejillones</h3>
            <p class="product-price">€13.45/kg</p>
            <div class="product-actions">
                <div class="quantity-selector">
                    <input type="number" value="1" min="1">
                    <button>-</button>
                    <button>+</button>
                </div>
                <button class="add-to-cart">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trabajo Empresa Frigorífica</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo de FríoMarket">
        </a>
    </div>
    <nav class="menu">
        <ul class="menu-links">
            @foreach ($categoriasPadre as $categoria)
                <li class="menu-item">
                    <a href="{{ route('products.byCategory', $categoria->id) }}">
                        {{ $categoria->nombre }}
                    </a>

                    @if ($categoria->imagen)
                        <a href="{{ route('products.byCategory', $categoria->id) }}">
                            <img src="{{ asset($categoria->imagen) }}" alt="Imagen de {{ $categoria->nombre }}" class="menu-image">
                        </a>
                    @endif

                    @if ($categoria->children->isNotEmpty())
                        <ul class="submenu">
                            @foreach ($categoria->children as $subcategoria)
                                <li>
                                    <a href="{{ route('products.byCategory', $subcategoria->id) }}">
                                        {{ $subcategoria->nombre }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="auth-buttons">
            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="login">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="register">Registrarse</a>
            @endauth
        </div>
    </nav>
</header>
<main>
    <div class="extra-sections">
        <nav class="menu">
            <ul class="menu-links">
                @foreach ($categoriasSinPadre as $categoria)
                    <li>
                        <a href="{{ route('products.byCategory', $categoria->id) }}">
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <div class="cart-container-wrapper">
        <span class="products-counter">
             Ir al carrito
        </span>

            <div class="cart-container">
                <a href="{{ route('shopping.cart') }}">
                    <img src="{{ asset('img/carrito.png') }}" alt="Carrito de compras" class="cart-icon">
                </a>
            </div>

        </div>
    </div>
    @if(session('pedido_completado'))
        <div class="alert alert-success text-center">
            Pedido completado. Puedes recogerlo en nuestra tienda el {{ session('fecha_recogida') }}.
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('pedido.factura', session('pedido_id')) }}" class="btn btn-primary">
                <i class="fas fa-file-pdf"></i> Descargar Factura
            </a>
        </div>
        <script>
            localStorage.removeItem('cart');
            localStorage.removeItem('cartTotal');
        </script>
    @endif
    @if(session('pedido_borrado'))
        <div class="alert alert-success text-center">
            Pedido borrado correctamente.
        </div>
        <script>
            localStorage.removeItem('cart');
            localStorage.removeItem('cartTotal');
        </script>
    @endif

    @if(!isset($nombreCategoria))
        @auth
            <h1 class="section-title">Bienvenido, {{ auth()->user()->first_name }}</h1>
        @else
            <h1 class="section-title">Bienvenido a la web de Frío Market</h1>
        @endauth
        <div class="image-block">
            <img src="{{ asset('img/tienda.jpg') }}" alt="Imagen destacada de FríoMarket" class="featured-image">
        </div>
    @else
        <h1 class="section-title">{{ $nombreCategoria }}</h1>
    @endif
    <div class="products-section">
        <div class="products-grid">
            @foreach ($productos as $producto)
                <div class="product-card" data-id="{{ $producto->id }}" data-stock="{{ $producto->stock }}">
                    <img src="{{ asset($producto->imagen_url) }}" alt="Imagen de {{ $producto->nombre }}" class="product-image">

                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <p class="product-price">€{{ number_format($producto->precio, 2) }}/kg</p>

                    <div class="product-actions">
                        <div class="quantity-selector">
                            <button class="increment">+</button>
                        </div>
                        <a href="{{ route('shopping.cart') }}" class="add-to-cart">
                            <img src="{{ asset('img/carrito.png') }}" alt="Carrito" class="cart-image">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
<footer class="footer">
    <div class="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo de FríoMarket">
        </a>
    </div>
    <p>Copyright © 2025 FrioMarket | Todos los derechos reservados</p>
    <div class="redes">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
        >
            <rect width="40" height="40" rx="4" fill="#FFFFFF" />
            <path
                d="M21.6265 28.0436V19.5156H24.8428L25.3243 16.1921H21.6264V14.0701C21.6264 13.1079 21.9266 12.4522 23.4771 12.4522L25.4545 12.4514V9.47884C25.1125 9.43841 23.9386 9.3479 22.5731 9.3479C19.7219 9.3479 17.77 10.8967 17.77 13.7411V16.1921H14.5454V19.5156H17.77V28.0435H21.6265V28.0436Z"
                fill="#1e81b0"
            />
        </svg>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
        >
            <rect width="40" height="40" rx="4" fill="white" />
            <path
                d="M23.3634 11.8903V11.8867H24.3012L24.6438 11.9552C24.8723 11.9996 25.0797 12.0578 25.266 12.1298C25.4524 12.2019 25.6327 12.2859 25.807 12.382C25.9814 12.478 26.1395 12.5759 26.2814 12.6755C26.422 12.774 26.5483 12.8784 26.6601 12.9889C26.7707 13.1005 26.9432 13.1294 27.1776 13.0753C27.4121 13.0213 27.6646 12.9463 27.9351 12.8502C28.2056 12.7542 28.4731 12.6461 28.7376 12.5261C29.0021 12.406 29.1632 12.3297 29.2209 12.2973C29.2774 12.2637 29.3075 12.2457 29.3111 12.2433L29.3147 12.2379L29.3327 12.2289L29.3508 12.2199L29.3688 12.2109L29.3868 12.2019L29.3904 12.1965L29.3959 12.1929L29.4013 12.1893L29.4049 12.1839L29.4229 12.1785L29.4409 12.1749L29.4373 12.2019L29.4319 12.2289L29.4229 12.2559L29.4139 12.2829L29.4049 12.3009L29.3959 12.3189L29.3868 12.346C29.3808 12.364 29.3748 12.388 29.3688 12.418C29.3628 12.448 29.3057 12.5681 29.1975 12.7782C29.0893 12.9883 28.954 13.2014 28.7917 13.4175C28.6294 13.6336 28.4839 13.7969 28.3553 13.9074C28.2254 14.019 28.1395 14.0971 28.0974 14.1415C28.0553 14.1871 28.0042 14.2291 27.9441 14.2676L27.8539 14.327L27.8359 14.336L27.8179 14.345L27.8143 14.3504L27.8088 14.354L27.8034 14.3576L27.7998 14.363L27.7818 14.372L27.7638 14.381L27.7602 14.3864L27.7547 14.39L27.7493 14.3936L27.7457 14.399L27.7421 14.4044L27.7367 14.408L27.7313 14.4116L27.7277 14.417H27.8179L28.3228 14.309C28.6595 14.2369 28.9811 14.1499 29.2876 14.0478L29.7746 13.8858L29.8287 13.8677L29.8557 13.8587L29.8738 13.8497L29.8918 13.8407L29.9098 13.8317L29.9279 13.8227L29.9639 13.8173L30 13.8137V13.8497L29.991 13.8533L29.982 13.8587L29.9784 13.8641L29.9729 13.8677L29.9675 13.8713L29.9639 13.8768L29.9603 13.8822L29.9549 13.8858L29.9495 13.8894L29.9459 13.8948L29.9423 13.9002L29.9369 13.9038L29.9279 13.9218L29.9188 13.9398L29.9134 13.9434C29.911 13.947 29.8347 14.049 29.6844 14.2495C29.5341 14.4512 29.453 14.5533 29.4409 14.5557C29.4289 14.5593 29.4121 14.5773 29.3904 14.6097C29.37 14.6433 29.2426 14.7772 29.0081 15.0113C28.7737 15.2455 28.5441 15.4538 28.3192 15.6363C28.0932 15.82 27.979 16.0457 27.9766 16.3134C27.973 16.58 27.9591 16.8813 27.9351 17.2175C27.911 17.5537 27.866 17.9168 27.7998 18.307C27.7337 18.6973 27.6315 19.1385 27.4932 19.6307C27.355 20.123 27.1867 20.6032 26.9883 21.0715C26.7899 21.5397 26.5825 21.9599 26.3661 22.3321C26.1497 22.7043 25.9513 23.0195 25.771 23.2776C25.5906 23.5358 25.4073 23.7789 25.2209 24.007C25.0346 24.2351 24.7989 24.4921 24.514 24.7778C24.2278 25.0624 24.0716 25.2184 24.0451 25.246C24.0175 25.2725 23.8996 25.3709 23.6916 25.5414C23.4848 25.7131 23.2624 25.8848 23.0243 26.0565C22.7875 26.227 22.5699 26.3692 22.3715 26.4833C22.1731 26.5973 21.9339 26.7276 21.6537 26.8741C21.3748 27.0218 21.073 27.1586 20.7484 27.2847C20.4238 27.4108 20.0812 27.5278 19.7205 27.6359C19.3598 27.7439 19.0111 27.828 18.6745 27.888C18.3379 27.948 17.9561 27.9991 17.5293 28.0411L16.8891 28.1041V28.1131H15.7169V28.1041L15.5636 28.0951C15.4614 28.0891 15.3772 28.0831 15.3111 28.0771C15.245 28.0711 14.9955 28.0381 14.5627 27.9781C14.1298 27.918 13.7902 27.858 13.5437 27.798C13.2973 27.7379 12.9306 27.6239 12.4436 27.4558C11.9567 27.2877 11.5401 27.1178 11.1939 26.9461C10.8488 26.7756 10.6324 26.6676 10.5446 26.622C10.4581 26.5775 10.3607 26.5223 10.2525 26.4563L10.0902 26.3572L10.0866 26.3518L10.0812 26.3482L10.0757 26.3446L10.0721 26.3392L10.0541 26.3302L10.0361 26.3212L10.0325 26.3158L10.0271 26.3122L10.0216 26.3086L10.018 26.3032L10.0144 26.2978L10.009 26.2942H10V26.2582L10.018 26.2618L10.0361 26.2672L10.1172 26.2762C10.1713 26.2822 10.3186 26.2912 10.5591 26.3032C10.7995 26.3152 11.055 26.3152 11.3255 26.3032C11.596 26.2912 11.8726 26.2642 12.1551 26.2222C12.4376 26.1801 12.7713 26.1081 13.156 26.006C13.5407 25.904 13.8942 25.7827 14.2164 25.6423C14.5374 25.5006 14.7659 25.3949 14.9017 25.3253C15.0364 25.2569 15.242 25.1296 15.5185 24.9435L15.9333 24.6643L15.9369 24.6589L15.9423 24.6553L15.9477 24.6517L15.9513 24.6463L15.9549 24.6409L15.9603 24.6373L15.9658 24.6337L15.9693 24.6283L15.9874 24.6229L16.0054 24.6193L16.009 24.6013L16.0144 24.5833L16.0199 24.5797L16.0234 24.5743L15.8792 24.5653C15.783 24.5593 15.6898 24.5533 15.5996 24.5473C15.5095 24.5413 15.3682 24.5143 15.1758 24.4662C14.9835 24.4182 14.7761 24.3462 14.5537 24.2501C14.3312 24.1541 14.1148 24.04 13.9044 23.908C13.694 23.7759 13.5419 23.666 13.4482 23.5784C13.3556 23.4919 13.2353 23.3695 13.0875 23.211C12.9408 23.0513 12.8133 22.8874 12.7051 22.7193C12.5969 22.5513 12.4935 22.3573 12.395 22.1376L12.2453 21.8099L12.2362 21.7829L12.2272 21.7558L12.2218 21.7378L12.2182 21.7198L12.2453 21.7234L12.2723 21.7288L12.4707 21.7558C12.603 21.7738 12.8104 21.7798 13.0929 21.7738C13.3754 21.7679 13.5708 21.7558 13.679 21.7378C13.7872 21.7198 13.8533 21.7078 13.8774 21.7018L13.9134 21.6928L13.9585 21.6838L14.0036 21.6748L14.0072 21.6694L14.0126 21.6658L14.0181 21.6622L14.0216 21.6568L13.9856 21.6478L13.9495 21.6388L13.9134 21.6298L13.8774 21.6208L13.8413 21.6118C13.8173 21.6058 13.7752 21.5938 13.7151 21.5757C13.655 21.5577 13.4926 21.4917 13.2281 21.3776C12.9636 21.2636 12.7532 21.1525 12.5969 21.0445C12.4402 20.9361 12.2908 20.8176 12.1497 20.6897C12.009 20.56 11.8545 20.3931 11.6862 20.189C11.5179 19.9849 11.3676 19.7478 11.2353 19.4777C11.1031 19.2075 11.0039 18.9494 10.9378 18.7033C10.8719 18.4586 10.8285 18.2084 10.808 17.9559L10.7755 17.5777L10.7935 17.5813L10.8115 17.5867L10.8296 17.5957L10.8476 17.6047L10.8656 17.6137L10.8837 17.6227L11.1632 17.7488C11.3496 17.8328 11.581 17.9048 11.8575 17.9649C12.1341 18.0249 12.2994 18.0579 12.3535 18.0639L12.4346 18.0729H12.5969L12.5933 18.0675L12.5879 18.0639L12.5825 18.0603L12.5789 18.0549L12.5753 18.0495L12.5699 18.0459L12.5645 18.0423L12.5609 18.0369L12.5428 18.0279L12.5248 18.0189L12.5212 18.0135L12.5158 18.0099L12.5104 18.0063L12.5068 18.0009L12.4887 17.9919L12.4707 17.9829L12.4671 17.9775C12.4635 17.9751 12.4118 17.9367 12.312 17.8622C12.2134 17.7866 12.11 17.6887 12.0018 17.5687C11.8936 17.4486 11.7854 17.3225 11.6772 17.1905C11.5688 17.0581 11.4722 16.9165 11.3886 16.7673C11.3045 16.6172 11.2155 16.4263 11.1217 16.1946C11.0292 15.964 10.9588 15.7317 10.9107 15.4976C10.8627 15.2635 10.8356 15.0324 10.8296 14.8042C10.8236 14.5761 10.8296 14.381 10.8476 14.2189C10.8656 14.0568 10.9017 13.8737 10.9558 13.6696C11.0099 13.4655 11.0881 13.2494 11.1903 13.0213L11.3436 12.6791L11.3526 12.6521L11.3616 12.6251L11.367 12.6215L11.3706 12.6161L11.3742 12.6107L11.3796 12.6071L11.385 12.6107L11.3886 12.6161L11.3922 12.6215L11.3977 12.6251L11.4031 12.6287L11.4067 12.6341L11.4103 12.6395L11.4157 12.6431L11.4247 12.6611L11.4337 12.6791L11.4392 12.6827L11.4427 12.6881L11.6862 12.9583C11.8485 13.1384 12.0409 13.3395 12.2633 13.5616C12.4857 13.7837 12.609 13.899 12.633 13.9074C12.6571 13.917 12.6871 13.9446 12.7232 13.9902C12.7592 14.0346 12.8795 14.1409 13.0839 14.309C13.2883 14.4771 13.5558 14.6722 13.8864 14.8943C14.217 15.1164 14.5837 15.3355 14.9865 15.5516C15.3893 15.7677 15.8221 15.9628 16.2849 16.1369C16.7478 16.311 17.0724 16.4251 17.2588 16.4791C17.4452 16.5331 17.7638 16.6022 18.2146 16.6862C18.6655 16.7703 19.0051 16.8243 19.2335 16.8483C19.462 16.8723 19.6183 16.8861 19.7024 16.8897L19.8287 16.8933L19.8251 16.8663L19.8197 16.8393L19.7836 16.6142C19.7595 16.4641 19.7475 16.254 19.7475 15.9838C19.7475 15.7137 19.7686 15.4646 19.8106 15.2365C19.8527 15.0083 19.9159 14.7772 20 14.5431C20.0842 14.309 20.1665 14.1211 20.2471 13.9794C20.3288 13.8389 20.4358 13.6786 20.5681 13.4986C20.7003 13.3185 20.8717 13.1324 21.0821 12.9403C21.2925 12.7482 21.5329 12.5771 21.8034 12.427C22.0739 12.2769 22.3234 12.1629 22.5518 12.0848C22.7803 12.0068 22.9727 11.9557 23.1289 11.9317C23.2852 11.9077 23.3634 11.8939 23.3634 11.8903Z"
                fill="#1DA1F2"
            />
        </svg>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
        >
            <rect width="40" height="40" rx="4" fill="white" />
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10 20C10 16.0054 10 14.0081 10.9519 12.5695C11.3769 11.9271 11.9271 11.3769 12.5695 10.9519C14.0081 10 16.0054 10 20 10C23.9946 10 25.9919 10 27.4305 10.9519C28.0729 11.3769 28.6231 11.9271 29.0481 12.5695C30 14.0081 30 16.0054 30 20C30 23.9946 30 25.9919 29.0481 27.4305C28.6231 28.0729 28.0729 28.6231 27.4305 29.0481C25.9919 30 23.9946 30 20 30C16.0054 30 14.0081 30 12.5695 29.0481C11.9271 28.6231 11.3769 28.0729 10.9519 27.4305C10 25.9919 10 23.9946 10 20ZM25.1769 20.0003C25.1769 22.8595 22.8591 25.1774 19.9998 25.1774C17.1406 25.1774 14.8227 22.8595 14.8227 20.0003C14.8227 17.141 17.1406 14.8231 19.9998 14.8231C22.8591 14.8231 25.1769 17.141 25.1769 20.0003ZM19.9998 23.4258C21.8917 23.4258 23.4254 21.8921 23.4254 20.0003C23.4254 18.1084 21.8917 16.5747 19.9998 16.5747C18.1079 16.5747 16.5743 18.1084 16.5743 20.0003C16.5743 21.8921 18.1079 23.4258 19.9998 23.4258ZM25.3814 15.7795C26.0533 15.7795 26.5979 15.2349 26.5979 14.563C26.5979 13.8912 26.0533 13.3466 25.3814 13.3466C24.7096 13.3466 24.1649 13.8912 24.1649 14.563C24.1649 15.2349 24.7096 15.7795 25.3814 15.7795Z"
                fill="url(#paint0_radial_43_244)"
            />
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10 20C10 16.0054 10 14.0081 10.9519 12.5695C11.3769 11.9271 11.9271 11.3769 12.5695 10.9519C14.0081 10 16.0054 10 20 10C23.9946 10 25.9919 10 27.4305 10.9519C28.0729 11.3769 28.6231 11.9271 29.0481 12.5695C30 14.0081 30 16.0054 30 20C30 23.9946 30 25.9919 29.0481 27.4305C28.6231 28.0729 28.0729 28.6231 27.4305 29.0481C25.9919 30 23.9946 30 20 30C16.0054 30 14.0081 30 12.5695 29.0481C11.9271 28.6231 11.3769 28.0729 10.9519 27.4305C10 25.9919 10 23.9946 10 20ZM25.1769 20.0003C25.1769 22.8595 22.8591 25.1774 19.9998 25.1774C17.1406 25.1774 14.8227 22.8595 14.8227 20.0003C14.8227 17.141 17.1406 14.8231 19.9998 14.8231C22.8591 14.8231 25.1769 17.141 25.1769 20.0003ZM19.9998 23.4258C21.8917 23.4258 23.4254 21.8921 23.4254 20.0003C23.4254 18.1084 21.8917 16.5747 19.9998 16.5747C18.1079 16.5747 16.5743 18.1084 16.5743 20.0003C16.5743 21.8921 18.1079 23.4258 19.9998 23.4258ZM25.3814 15.7795C26.0533 15.7795 26.5979 15.2349 26.5979 14.563C26.5979 13.8912 26.0533 13.3466 25.3814 13.3466C24.7096 13.3466 24.1649 13.8912 24.1649 14.563C24.1649 15.2349 24.7096 15.7795 25.3814 15.7795Z"
                fill="url(#paint1_linear_43_244)"
                fill-opacity="0.74"
            />
            <defs>
                <radialGradient
                    id="paint0_radial_43_244"
                    cx="0"
                    cy="0"
                    r="1"
                    gradientUnits="userSpaceOnUse"
                    gradientTransform="translate(22.8066 13.8214) rotate(127.758) scale(19.3612)"
                >
                    <stop offset="0" stop-color="#FA2D9B" />
                    <stop offset="0.660765" stop-color="#FD8451" />
                    <stop offset="1" stop-color="#FFD231" />
                </radialGradient>
                <linearGradient
                    id="paint1_linear_43_244"
                    x1="12.0016"
                    y1="10"
                    x2="20"
                    y2="30"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop offset="0" stop-color="#8423FF" />
                    <stop offset="1" stop-color="#FF8819" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", async () => {
        let cart = JSON.parse(localStorage.getItem("cart")) || {};

        async function loadCart() {
            try {
                const response = await fetch("/cart");
                if (response.ok) {
                    const serverCart = await response.json();
                    if (serverCart && Object.keys(serverCart).length > 0) {
                        cart = serverCart;
                        localStorage.setItem("cart", JSON.stringify(cart));
                    }
                }
            } catch (error) {
                console.error("Error al cargar el carrito:", error);
            }
        }

        let updatingCart = false;
        async function updateCart(productId, quantity, productName = null, price = null, imageUrl = null) {
            updatingCart = true;

            if (quantity === null) {
                delete cart[productId];
                localStorage.setItem("cart", JSON.stringify(cart));
            } else {
                const existing = cart[productId] || {};
                const nombre = productName ?? existing.nombre ?? "";
                const precio = price ?? existing.price ?? 0;
                const imagen = imageUrl ?? existing.image ?? "";

                cart[productId] = {
                    quantity,
                    nombre,
                    price: precio,
                    image: imagen
                };

                localStorage.setItem("cart", JSON.stringify(cart));
            }

            try {
                const response = await fetch("/cart/update", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({
                        [productId]: quantity === null ? { quantity: 0 } : cart[productId]
                    }),
                });

                if (response.ok) {
                    await response.json();
                }
            } catch (error) {
                console.error("Error al actualizar el carrito:", error);
            } finally {
                updatingCart = false;
            }
        }

        document.querySelector(".cart-container a").addEventListener("click", (e) => {
            if (updatingCart) {
                e.preventDefault();
                alert("Espera un momento mientras se actualiza el carrito...");
            }
        });

        document.querySelectorAll(".increment").forEach(button => {
            button.addEventListener("click", async () => {
                const productCard = button.closest(".product-card");
                const productId = productCard.getAttribute("data-id");
                const productName = productCard.querySelector(".product-title").textContent;
                const priceText = productCard.querySelector(".product-price").textContent;
                const imageUrl = productCard.querySelector(".product-image").getAttribute("src");
                const pricePerKg = parseFloat(priceText.replace(/[^\d,.-]/g, "").replace(",", "."));
                const stock = parseInt(productCard.getAttribute("data-stock") || "0", 10);

                if (!cart[productId]) {
                    if (stock > 0) {
                        cart[productId] = { nombre: productName, price: pricePerKg, quantity: 1, image: imageUrl };
                        alert(`Producto añadido al carrito`);
                    } else {
                        alert(`No hay stock disponible para ${productName}.`);
                        return;
                    }
                } else {
                    if (cart[productId].quantity < stock) {
                        cart[productId].quantity += 1;
                        alert(`Producto añadido al carrito`);
                    } else {
                        alert(`No puedes añadir más unidades de ${productName}. Stock máximo alcanzado.`);
                        return;
                    }
                }

                await updateCart(productId, cart[productId].quantity, productName, pricePerKg, imageUrl);
            });
        });

        loadCart();
    });
</script>
</body>
</html>

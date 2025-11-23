<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda 3D</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Archivo CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/circle-gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    
</head>
<body class="bg-light">

    {{-- === HEADER === --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">MARCA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                        <ul class="navbar-nav ms-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endguest

                            @auth
                                @if (Auth::user()->is_admin)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-danger fw-bold">
                                            ADMIN
                                        </a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <span class="nav-link fw-bold">Hola, {{ Auth::user()->name }}</span>
                                </li>

                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm ms-2">Cerrar sesión</button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>

    {{-- === HERO === --}}
    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <br>
        </div>
    </section>

    {{-- === Circle gallery === --}}
    <section class="circle-gallery">
        
    <div class="circle-row">
        {{-- === TODO === --}}
        <div class="circle-item active" data-category="all">
        <img src="{{ asset('img/circle-gallery-logos/all_logo.png')  }}" alt="Todo" class="circle-img">
        </div>

        {{-- === categorias === --}}
        <div class="circle-item" data-category="dc">
            <img src="{{ asset('img/circle-gallery-logos/dc_logo.png') }}" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="dragon_ball">
            <img src="{{ asset('img/circle-gallery-logos/dragon_logo.png') }}" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="marvel">
            <img src="{{ asset('img/circle-gallery-logos/marvel_logo.png') }}" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="pokemon">
            <img src="{{ asset('img/circle-gallery-logos/pokemon_logo.png') }}" class="circle-img">
            
        </div>
        <div class="circle-item">
            <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" class="circle-img">
            
        </div>
        <div class="circle-item">
            <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" class="circle-img">
            
        </div>
    </div>
</section>

{{-- === Circle gallery control === --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryButtons = document.querySelectorAll('.circle-item');
    const productCols = document.querySelectorAll('.product-card'); // cada col contiene una card

    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedCategory = button.getAttribute('data-category');

            // Marcar categoría activa
            categoryButtons.forEach(b => b.classList.remove('active'));
            button.classList.add('active');

            // Filtrar productos
            productCols.forEach(col => {
                const cardCategory = col.getAttribute('data-category');

                if (selectedCategory === 'all' || selectedCategory === cardCategory) {
                    col.classList.remove('d-none'); // muestra columna
                } else {
                    col.classList.add('d-none'); // oculta columna
                }
            });
        });
    });
});
</script>

<!-- === Sección de detalle de producto === -->
<div id="product-detail" class="d-none container py-5">

    <div class="row">

        <!-- Imagen grande -->
        <div class="detail-main-wrap">
            <img id="detail-img" class="img-fluid rounded shadow" alt="">
        </div>

        <!-- Información del producto -->
        <div class="col-md-6">

            <h2 id="detail-name" class="fw-bold"></h2>

            <p id="detail-price" class="text-primary fw-bold fs-4"></p>

            <button class="btn btn-dark mb-2 w-100">Comprar</button>
            <button class="btn btn-outline-dark mb-3 w-100">Añadir al carrito</button>

            <p id="detail-desc" class="mt-3"></p>

            <!-- Miniaturas dinámicas -->
            <h5 class="mt-4 mb-2 fw-bold">Vistas adicionales</h5>
            <div id="detail-thumbs" class="d-flex gap-2 flex-wrap"></div>

            <!-- Botón cerrar -->
            <button id="close-detail" class="btn btn-danger mt-4">Cerrar</button>

        </div>

    </div>

</div>


</section>


 <section class="py-5">
    <div class="container">
        <div class="row justify-content-center g-4">

            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" 
                    data-category="{{ $product->category }}"
                    data-image="{{ asset('storage/' . $product->image) }}"
                    data-image2="{{ asset('storage/' . $product->image2) }}"
                    data-image3="{{ asset('storage/' . $product->image3) }}"
                    data-name="{{ $product->name }}"
                    data-price="S/ {{ number_format($product->price, 2) }}"
                    data-desc="{{ $product->description }}">

                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                class="card-img-top product-img" 
                                alt="{{ $product->name }}"
                            >
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ $product->name }}</h5>

                            <span class="fw-bold text-primary fs-5">
                                S/ {{ number_format($product->price, 2) }}
                            </span>

                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('.product-card');
    const detailSection = document.getElementById('product-detail');
    const gridSection = document.querySelector('.row.g-4');

    const detailImg = document.getElementById('detail-img');
    const detailName = document.getElementById('detail-name');
    const detailPrice = document.getElementById('detail-price');
    const detailDesc = document.getElementById('detail-desc');
    const detailThumbs = document.getElementById('detail-thumbs');
    const closeBtn = document.getElementById('close-detail');

    productCards.forEach(card => {
        const img = card.querySelector('.product-img');

        img.addEventListener('click', () => {

            // Rellenar datos principales
            detailImg.src = card.dataset.image;
            detailName.textContent = card.dataset.name;
            detailPrice.textContent = card.dataset.price;
            detailDesc.textContent = card.dataset.desc;

            // Limpiar miniaturas anteriores
            detailThumbs.innerHTML = '';

            // Crear lista de imágenes
            const images = [
                card.dataset.image,
                card.dataset.image2,
                card.dataset.image3
            ];

            // Generar miniaturas dinámicamente
            images.forEach(src => {
                if (!src) return;
                const thumb = document.createElement('img');
                thumb.src = src;
                thumb.classList.add('img-thumbnail');
                thumb.style.width = "80px";
                thumb.style.cursor = "pointer";

                // Al hacer clic en miniatura → cambia imagen grande
                thumb.addEventListener('click', () => {
                    detailImg.src = src;
                });

                detailThumbs.appendChild(thumb);
            });

            // Mostrar sección de detalle
            gridSection.classList.add('d-none');
            detailSection.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Botón cerrar
    closeBtn.addEventListener('click', () => {
        detailSection.classList.add('d-none');
        gridSection.classList.remove('d-none');
    });
});
</script>

   

    {{-- === FOOTER === --}}
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p class="mb-1">&copy; {{ date('Y') }} MARCA. Todos los derechos reservados.</p>
        <p class="mb-0 small text-secondary">Hecho con ❤️</p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

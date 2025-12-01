<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tienda 3D</title>

    {{-- Token CSRF para AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    {{-- Archivos CSS propios --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/circle-gallery.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}" />
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}" />
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

                    <!-- Ícono del carrito -->
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span id="cart-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                @if (session('cart'))
                                    {{ array_sum(array_column(session('cart'), 'quantity')) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- === Carousel y categorias (circle gallery) === --}}
    <section class="circle-gallery">
        <div class="circle-row">
            <div class="circle-item active" data-category="all">
                <img src="{{ asset('img/circle-gallery-logos/all_logo.png') }}" alt="Todo" class="circle-img" />
            </div>
            <div class="circle-item" data-category="dc">
                <img src="{{ asset('img/circle-gallery-logos/dc_logo.png') }}" class="circle-img" />
            </div>
            <div class="circle-item" data-category="dragon_ball">
                <img src="{{ asset('img/circle-gallery-logos/dragon_logo.png') }}" class="circle-img" />
            </div>
            <div class="circle-item" data-category="marvel">
                <img src="{{ asset('img/circle-gallery-logos/marvel_logo.png') }}" class="circle-img" />
            </div>
            <div class="circle-item" data-category="pokemon">
                <img src="{{ asset('img/circle-gallery-logos/pokemon_logo.png') }}" class="circle-img" />
            </div>
            <div class="circle-item">
                <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" class="circle-img" />
            </div>
            <div class="circle-item">
                <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" class="circle-img" />
            </div>
        </div>
    </section>

    {{-- === Filtro de categorías === --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryButtons = document.querySelectorAll('.circle-item');
            const productCols = document.querySelectorAll('.product-card'); // columnas contenedoras de producto

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const selectedCategory = button.getAttribute('data-category');

                    categoryButtons.forEach(b => b.classList.remove('active'));
                    button.classList.add('active');

                    productCols.forEach(col => {
                        const cardCategory = col.getAttribute('data-category');

                        if (selectedCategory === 'all' || selectedCategory === cardCategory) {
                            col.classList.remove('d-none');
                        } else {
                            col.classList.add('d-none');
                        }
                    });
                });
            });
        });
    </script>

    {{-- === Sección de detalle de producto === --}}
    <div id="product-detail" class="d-none container py-5">
        <div class="row">
            <div class="detail-main-wrap">
                <img id="detail-img" class="img-fluid rounded shadow" alt="" />
            </div>

            <div class="col-md-6">
                <h2 id="detail-name" class="fw-bold"></h2>
                <p id="detail-price" class="text-primary fw-bold fs-4"></p>

                <!-- Formulario para añadir producto al carrito -->
                <form id="detail-add-to-cart-form" action="" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" id="detail-product-id" value="" />
                    <button type="submit" class="btn btn-outline-dark mb-3 w-100">Añadir al carrito</button>
                </form>

                <p id="detail-desc" class="mt-3"></p>

                <p id="detail-stock" class="text-muted">Stock disponible: <span id="stock-value"></span></p>

                <h5 class="mt-4 mb-2 fw-bold">Vistas adicionales</h5>
                <div id="detail-thumbs" class="d-flex gap-2 flex-wrap"></div>

                <button id="close-detail" class="btn btn-danger mt-4">Cerrar</button>
            </div>
        </div>
    </div>

    {{-- === Productos listados === --}}
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center g-4">
                @foreach ($products as $product)
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-3 product-card"
                        data-category="{{ $product->category }}"
                        data-image="{{ asset('storage/' . $product->image) }}"
                        data-image2="{{ asset('storage/' . $product->image2) }}"
                        data-image3="{{ asset('storage/' . $product->image3) }}"
                        data-name="{{ $product->name }}"
                        data-price="S/ {{ number_format($product->price, 2) }}"
                        data-desc="{{ $product->description }}"
                        data-id="{{ $product->id }}"
                        data-stock="{{ $product->stock }}"
                    >
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-wrap">
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="card-img-top product-img"
                                />
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <span class="fw-bold text-primary fs-5">S/ {{ number_format($product->price, 2) }}</span>
                                <button class="btn btn-dark btn-sm">Comprar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- === Scripts para detalle y carrito === --}}
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
            const detailProductId = document.getElementById('detail-product-id');
            const detailForm = document.getElementById('detail-add-to-cart-form');
            const closeBtn = document.getElementById('close-detail');

            // Mostrar detalle con datos dinámicos
            productCards.forEach(card => {
                const img = card.querySelector('.product-img');

                img.addEventListener('click', () => {
                    detailImg.src = card.dataset.image;
                    detailName.textContent = card.dataset.name;
                    detailPrice.textContent = card.dataset.price;
                    detailDesc.textContent = card.dataset.desc;
                    detailProductId.value = card.dataset.id;
                    detailForm.action = "{{ url('/cart/add') }}/" + card.dataset.id;
                    document.getElementById('stock-value').textContent = card.dataset.stock;

                    detailThumbs.innerHTML = '';
                    const images = [card.dataset.image, card.dataset.image2, card.dataset.image3];

                    images.forEach(src => {
                        if (!src) return;
                        const thumb = document.createElement('img');
                        thumb.src = src;
                        thumb.classList.add('img-thumbnail');
                        thumb.style.width = '80px';
                        thumb.style.cursor = 'pointer';

                        thumb.addEventListener('click', () => {
                            detailImg.src = src;
                        });

                        detailThumbs.appendChild(thumb);
                    });

                    gridSection.classList.add('d-none');
                    detailSection.classList.remove('d-none');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });

            // Cerrar detalle
            closeBtn.addEventListener('click', () => {
                detailSection.classList.add('d-none');
                gridSection.classList.remove('d-none');
            });

            // Añadir al carrito vía AJAX con fetch
            detailForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const data = new FormData(detailForm);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(detailForm.action, {
                    method: 'POST',
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) return response.json().then(err => Promise.reject(err));
                    return response.json();
                })
                .then(data => {
                    document.getElementById('cart-count').innerText = data.totalQuantity;
                    alert('Producto añadido al carrito!');
                })
                .catch(error => {
                    if (error.error) alert(error.error);
                    else alert('Error al agregar al carrito');
                    console.error('Error al agregar al carrito:', error);
                });
            });
        });
    </script>

    {{-- Bootstrap JS y jQuery --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Scripts compilados Laravel Mix --}}
    <script src="{{ mix('js/script.js') }}"></script>
</body>
</html>
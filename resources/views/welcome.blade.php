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
                    <li class="nav-item"><a class="nav-link active" href="#">LOGIN</a></li>
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
            <img src="{{ asset('img/circle-gallery-logos/dc_logo.png') }}" alt="PLA" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="dragon_ball">
            <img src="{{ asset('img/circle-gallery-logos/dragon_logo.png') }}" alt="ABS" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="marvel">
            <img src="{{ asset('img/circle-gallery-logos/marvel_logo.png') }}" alt="PETG" class="circle-img">
            
        </div>
        <div class="circle-item" data-category="pokemon">
            <img src="{{ asset('img/circle-gallery-logos/pokemon_logo.png') }}" alt="Resina" class="circle-img">
            
        </div>
        <div class="circle-item">
            <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" alt="Resina" class="circle-img">
            
        </div>
        <div class="circle-item">
            <img src="{{ asset('img/circle-gallery-logos/onepiece_logo.png') }}" alt="Resina" class="circle-img">
            
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
<section id="product-detail" class="d-none py-5">
  <div class="container">
    <div class="row align-items-center">
      <!-- Imagen grande -->
      <div class="col-md-6 text-center">
        <img id="detail-img" src="" class="img-fluid rounded shadow" alt="Producto seleccionado" style="max-height: 400px; object-fit: cover;">
      </div>

      <!-- Información del producto -->
      <div class="col-md-6">
        <h3 id="detail-name" class="fw-bold mb-3"></h3>
        <p id="detail-desc" class="text-muted mb-4"></p>
        <h4 id="detail-price" class="text-primary mb-4"></h4>

        <div class="d-flex gap-3">
          <button class="btn btn-dark">Comprar</button>
          <button class="btn btn-outline-dark">Agregar al carrito</button>
        </div>

        <button id="close-detail" class="btn btn-link mt-4 text-danger">← Volver a productos</button>
      </div>
    </div>
  </div>
</section>


 {{-- === PRODUCTOS === --}}
    <section class="py-5">
        <div class="container">
             <div class="row justify-content-center g-4">

                {{-- CARD 1 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card"
                data-category="pokemon"
                data-name="Charmander Chibi"
                data-price="S/ 35.00"
                data-desc="Figura impresa en 3D de Charmander en estilo chibi, pintada a mano. Ideal para coleccionistas y fans de Pokémon."
                data-image="{{ asset('img/pokemon/charmander/charmander_chibi_1.jpg') }}">
            
            <div class="card h-100 shadow-sm">
                <div class="card-img-wrap">
                <img src="{{ asset('img/pokemon/charmander/charmander_chibi_1.jpg') }}"
                    class="card-img-top product-img"
                    alt="Charmander Chibi">
                </div>

                <div class="card-body d-flex flex-column justify-content-between text-center">
                <h5 class="card-title">Charmander Chibi</h5>
                <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                <button class="btn btn-dark btn-sm mt-2">Comprar</button>
                </div>
            </div>
            </div>

                {{-- CARD 1 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="pokemon">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/charmander/charmander_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Charmander Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 1 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="pokemon">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/charmander/charmander_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Charmander Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 1 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="pokemon">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/charmander/charmander_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Charmander Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3  product-card" data-category="marvel">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/eevee/eevee_ball_full.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Eevee Ball</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3  product-card" data-category="marvel">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/eevee/eevee_ball_full.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Eevee Ball</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3  product-card" data-category="marvel">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/eevee/eevee_ball_full.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Eevee Ball</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3  product-card" data-category="marvel">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/eevee/eevee_ball_full.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Eevee Ball</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>
                

                {{-- CARD 3 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dragon_ball">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/pichu/pichu_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Pichu</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>  
                
                {{-- CARD 3 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dragon_ball">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/pichu/pichu_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Pichu</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div> 

                {{-- CARD 3 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dragon_ball">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/pichu/pichu_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Pichu</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div> 

                {{-- CARD 3 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dragon_ball">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/pichu/pichu_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Pichu</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div> 

                {{-- CARD 4 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dc">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/umbreon/umbreon_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Umbreon Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dc">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/umbreon/umbreon_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Umbreon Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dc">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/umbreon/umbreon_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Umbreon Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 product-card" data-category="dc">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-wrap">
                            <img src="{{ asset('img/pokemon/umbreon/umbreon_chibi_1.jpg') }}" class="card-img-top product-img" alt="Soporte">
                        </div>
                       <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">Umbreon Chibi</h5>
                            <span class="fw-bold text-primary fs-5">S/ 35.00</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('.product-card');
    const detailSection = document.getElementById('product-detail');
    const gridSection = document.querySelector('.row.g-4'); // tu grilla de productos

    // Elementos dentro de la vista detalle
    const detailImg = document.getElementById('detail-img');
    const detailName = document.getElementById('detail-name');
    const detailPrice = document.getElementById('detail-price');
    const detailDesc = document.getElementById('detail-desc');
    const closeBtn = document.getElementById('close-detail');

    // Cuando se hace clic en una imagen de producto
    productCards.forEach(card => {
        const img = card.querySelector('.product-img');

        img.addEventListener('click', () => {
            detailImg.src = card.dataset.image;
            detailName.textContent = card.dataset.name;
            detailPrice.textContent = card.dataset.price;
            detailDesc.textContent = card.dataset.desc;

            gridSection.classList.add('d-none');  // Oculta los cards
            detailSection.classList.remove('d-none'); // Muestra el detalle
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Botón para cerrar el detalle
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

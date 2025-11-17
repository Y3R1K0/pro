@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                
                <div class="card-header bg-primary text-white text-center fw-bold">
                    Bienvenido
                </div>

                <div class="card-body text-center">

                    <h5 class="mb-3">¡Has iniciado sesión correctamente!</h5>

                    <p class="text-muted mb-4">
                        Estás dentro de tu panel de usuario.
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-lg btn-outline-primary px-4">
                        ← Volver a la tienda
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection

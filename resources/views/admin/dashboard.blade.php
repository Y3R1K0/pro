@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-bold text-center">
                    Panel de Administrador
                </div>

                <div class="card-body text-center">

                    <h4 class="mb-3">Bienvenido, Administrador</h4>

                    <p class="text-muted mb-4">
                        Aquí podrás gestionar productos, categorías y más.
                    </p>

                    <div class="d-flex justify-content-center mb-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger px-4 mx-2">
                            Gestionar Productos
                        </a>

                        <a href="{{ url('/') }}" class="btn btn-outline-primary px-4 mx-2">
                            Ir a la tienda
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection

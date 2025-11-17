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

                    <a href="{{ url('/admin/products') }}" class="btn btn-outline-danger px-4">
                        Gestionar Productos
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection

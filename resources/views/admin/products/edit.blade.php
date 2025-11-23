@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="fw-bold mb-4">Editar Producto</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.products.form')

        <button class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>

@endsection

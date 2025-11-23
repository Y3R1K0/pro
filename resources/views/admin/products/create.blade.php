@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="fw-bold mb-4">Crear Producto</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.products.form')

        <button class="btn btn-success mt-3">Guardar</button>
    </form>
</div>

@endsection

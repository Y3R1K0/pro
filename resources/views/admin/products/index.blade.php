@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-4 fw-bold">Productos</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
        + Crear nuevo producto
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>S/ {{ $product->price }}</td>
                    <td>
                        <img src="{{ asset($product->image) }}" width="60" class="rounded">
                    </td>

                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este producto?')">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection

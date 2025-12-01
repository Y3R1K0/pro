@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h2>Tu carrito de compras</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <ul class="list-group">
            @foreach(session('cart') as $id => $details)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $details['name'] }}</strong> - 
                        {{ $details['quantity'] }} x S/ {{ number_format($details['price'], 2) }}
                    </div>
                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            <h4>Total: S/ {{ number_format($total = array_sum(array_map(function($item) {
                return $item['quantity'] * $item['price'];
            }, session('cart'))), 2) }}</h4>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">Proceder al pago</a>
        </div>
    @else
        <p>No tienes productos en tu carrito.</p>
    @endif
</div>

@endsection
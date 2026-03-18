@extends('Layout.cmaster')

@section('title', 'My Cart')

@section('content')
<div class="container mt-4">
    <h3>My Cart</h3>

    @if(session('cart') && count(session('cart')) > 0)
        @php $grandTotal = 0; @endphp

        @foreach(session('cart') as $id => $item)
            @php 
                $total = $item['price'] * $item['qty']; 
                $grandTotal += $total;
            @endphp

            <div class="card mb-3 shadow-sm">
                <div class="row g-0 align-items-center">
                    <!-- Product Image -->
                    <div class="col-md-3 text-center p-2">
                        <img src="{{ asset('uploads/products/' . $item['image']) }}" 
                            alt="{{ $item['name'] }}" 
                            class="img-fluid rounded"
                            style="max-height: 150px; object-fit: contain;">
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text">Price: ₹{{ number_format($item['price']) }}</p>

                            <!-- Qty input -->
                            <div class="d-flex align-items-center mb-2">
                                <label class="me-2">Qty:</label>
                                <input type="number" min="1" value="{{ $item['qty'] }}"
                                    class="form-control d-inline-block w-auto update-cart"
                                    data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                            </div>

                            <!-- Subtotal -->
                            <p class="mb-2">Subtotal: ₹<span id="subtotal-{{ $id }}">{{ number_format($total) }}</span></p>

                            <!-- Remove button -->
                            <a href="{{ url('cart/remove/' . $id) }}" class="btn btn-outline-danger btn-sm">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Grand Total + Checkout -->
        <div class="text-end mt-4">

            <h4>Grand Total: ₹<span id="grand-total">{{ number_format($grandTotal) }}</span></h4>

            <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif
</div>
@endsection

@extends('Layout.cmaster')
@section('title', 'Checkout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Checkout</h2>

    {{-- Single form for checkout --}}
    <form action="{{ route('place.order') }}" method="POST">
        @csrf

        @if(isset($buy_now) && $buy_now)
            <input type="hidden" name="buy_now" value="1">
        @endif

        <div class="row">
            <!-- Left Side: Shipping Details -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Shipping Address</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="3" class="form-control" required>{{ old('address', $user->address ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">Order Summary</div>
                    <div class="card-body">

                        @php
                            // Decide which cart to show: Buy Now or normal cart
                            $cartItems = session('buy_now_cart', session('cart', []));
                        @endphp

                        @foreach($cartItems as $id => $item)
                            <div class="d-flex align-items-center border-bottom pb-2 mb-2">
                                <img src="{{ asset('uploads/products/'.$item['image']) }}" width="60" class="me-3 rounded">
                                <div class="flex-grow-1">
                                    <strong>{{ $item['name'] }}</strong><br>
                                    <small>₹{{ number_format($item['price']) }} × {{ $item['qty'] }}</small>
                                </div>
                                <div>
                                    <strong>₹{{ number_format($item['price'] * $item['qty']) }}</strong>
                                </div>
                            </div>
                        @endforeach

                        <h4 class="text-end mt-3">
                            Grand Total: ₹{{ number_format(collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty'])) }}
                        </h4>

                        <!-- Payment Method -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white">Payment Method</div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="COD" checked>
                                    <label class="form-check-label">Cash on Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="Card">
                                    <label class="form-check-label">Credit/Debit Card</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="UPI">
                                    <label class="form-check-label">UPI</label>
                                </div>

                                <div id="card-details" class="mt-3 d-none">
                                    <input type="text" name="card_number" class="form-control mb-2" placeholder="Card Number">
                                    <input type="text" name="card_name" class="form-control mb-2" placeholder="Name on Card">
                                    <input type="text" name="card_expiry" class="form-control mb-2" placeholder="MM/YY">
                                    <input type="text" name="card_cvv" class="form-control mb-2" placeholder="CVV">
                                </div>

                                <div id="upi-details" class="mt-3 d-none">
                                    <input type="text" name="upi_id" class="form-control" placeholder="Enter UPI ID">
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-lg">Place Order</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('input[name="payment_method"]').forEach(el => {
    el.addEventListener('change', function() {
        document.getElementById('card-details').classList.add('d-none');
        document.getElementById('upi-details').classList.add('d-none');

        if (this.value === 'Card') document.getElementById('card-details').classList.remove('d-none');
        if (this.value === 'UPI') document.getElementById('upi-details').classList.remove('d-none');
    });
});
</script>
@endsection

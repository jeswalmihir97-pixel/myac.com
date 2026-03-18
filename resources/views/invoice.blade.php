@extends('Layout.cmaster')

@section('title', 'Invoice')

@section('content')
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Invoice</h2>
            <small class="text-muted">Order Summary</small>
        </div>
        <div>
            <strong>Date:</strong> {{ $order->created_at->format('d M Y') }}
        </div>
    </div>
    <hr>

    <!-- Customer Info -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Customer Details</h5>
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <h5>Order Info</h5>
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p>
                <strong>Estimated Delivery:</strong> 
                @if($order->delivery_date)
                    {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}
                @else
                    Not Available
                @endif
            </p>
        </div>
    </div>

    <!-- Products Table -->
    <h4 class="mt-4">Products</h4>
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 60px;">Image</th>
                <th>Product</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Price</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        @if($item->product && $item->product->product_image)
                            <img src="{{ asset('uploads/products/' . $item->product->product_image) }}" 
                                 alt="{{ $item->product->product_name }}" 
                                 class="img-fluid rounded" style="max-width: 60px;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif 
                    </td>
                    <td>{{ $item->product->product_name ?? 'Deleted Product' }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                    <td class="text-end">₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Grand Total -->
    <div class="text-end mt-4">
        <h3 class="fw-bold">Grand Total: ₹{{ number_format($order->total, 2) }}</h3>
    </div>
</div>
@endsection

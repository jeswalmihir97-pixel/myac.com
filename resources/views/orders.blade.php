@extends('Layout.cmaster')

@section('title', 'My Orders')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Order History</h2>

    @forelse($orders as $order)
        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><strong>Order #{{ $order->id }}</strong></span>
                <span class="badge bg-light text-primary">{{ ucfirst($order->status ?? 'confirmed') }}</span>
            </div>
            
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h6 class="text-muted border-bottom pb-1">Customer Info</h6>
                        <p class="mb-1"><strong>Name:</strong> {{ $order->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                    </div>

                    <div class="col-md-4">
                        <h6 class="text-muted border-bottom pb-1">Order Summary</h6>
                        <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        <p class="mb-1"><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p class="mb-1"><strong>Delivery:</strong> {{ $order->delivery_date ? $order->delivery_date->format('d M Y') : 'Processing' }}</p>
                    </div>

                    <div class="col-md-4 text-md-end">
                        <h6 class="text-muted border-bottom pb-1">Actions</h6>
                        <a href="{{ route('invoice.show', $order->id) }}" class="btn btn-sm btn-outline-success mt-2">
                            <i class="fas fa-file-invoice"></i> View Invoice
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/products/' . $item->product->product_image) }}" 
                                             alt="{{ $item->product->product_name }}" 
                                             width="60" height="60" 
                                             style="object-fit:contain;"
                                             class="border rounded">
                                    </td>
                                    <td class="text-start">{{ $item->product->product_name }}</td>
                                    <td>{{ $item->product->brand_name }}</td>
                                    <td>{{ $item->product->product_size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price) }}</td>
                                    <td class="fw-bold">₹{{ number_format($item->price * $item->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <h5 class="fw-bold">Grand Total: 
                        <span class="text-success">₹{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity)) }}</span>
                    </h5>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <div class="alert alert-info">
                You haven't placed any orders yet. <a href="{{ url('/') }}" class="alert-link">Start Shopping</a>
            </div>
        </div>
    @endforelse
</div>
@endsection
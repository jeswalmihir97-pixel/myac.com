@extends('Layout.cmaster')

@section('title', 'My Orders')

@section('content')
<div class="container mt-4">

    @forelse($orders as $order)
        <div class="card mb-4 shadow-sm">

            {{-- Card Header --}}
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><strong>Order</strong></span>
                <span class="badge bg-success">
                    {{ ucfirst($order->status ?? 'confirmed') }}
                </span>
            </div>

            {{-- Order Details --}}
            <div class="card-body">
                <div class="row">

                    {{-- Left --}}
                    <div class="col-md-4">
                        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        <p><strong>Payment:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p><strong>Delivery Date:</strong> 
                            {{ $order->delivery_date ? $order->delivery_date->format('d M Y') : 'N/A' }}
                        </p>
                    </div>

                    {{-- Middle --}}
                    <div class="col-md-4">
                        <p><strong>Name:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                    </div>

                    {{-- Right --}}
                    <div class="col-md-4 text-end">
                        <h6>Action</h6>
                        <a href="{{ route('invoice.show', $order->id) }}" 
                           class="btn btn-sm btn-outline-success mt-2">
                            View Invoice
                        </a>
                    </div>

                </div>
            </div>

            {{-- Products Table --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center mb-0">
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
                                         style="object-fit:contain;">
                                </td>

                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->product->brand_name }}</td>
                                <td>{{ $item->product->product_size }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($item->price) }}</td>
                                <td>₹{{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Grand Total --}}
            <div class="text-end p-3">
                <h5>
                    Grand Total: 
                    <span class="text-success">
                        ₹{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity)) }}
                    </span>
                </h5>
            </div>

        </div>
    @empty
        <div class="alert alert-info text-center">
            No orders found.
        </div>
    @endforelse

</div>
@endsection
@extends('Layout.cmaster')

@section('title', 'Dashboard')

@section('content')
 <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <!-- Product Image -->
                    <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                         class="card-img-top bg-light"
                         alt="{{ $product->product_name }}"
                         style="height: 300px; object-fit: contain; padding: 10px;">

                    <!-- Product Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="text-muted mb-1"><strong>Brand:</strong> {{ $product->brand_name }}</p>
                        <p class="mb-1"><strong>Size:</strong> {{ $product->product_size }}</p>
                        <p class="mb-1"><strong>Price:</strong> ₹{{ number_format($product->product_price) }}</p>
                        <p class="small text-secondary">{{ Str::limit($product->product_details, 80) }}</p>

                        <!-- Quantity & Add to Cart -->
                        <form action="{{ url('cart/add/' . $product->id) }}" method="POST" class="mt-auto">
                            @csrf 
                            <div class="input-group mb-2" style="max-width: 160px;">
                                <label class="input-group-text">Qty</label>
                                <input type="number" name="qty" value="1" min="1" max="{{ $product->product_qty }}" class="form-control">
                            </div>
                            <button type="button" class="btn btn-primary btn-sm addToCartBtn" data-id="{{ $product->id }}">Add to Cart</button>
                        </form>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-2">
                            <!-- Buy Now -->
                            <form action="{{ route('buynow', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-success btn-sm">Buy Now</button>
                            </form>

                            <!-- Wishlist -->
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">❤️</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No products available right now.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

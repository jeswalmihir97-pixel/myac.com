@extends('Layout.cmaster')
@section('title', 'My Wishlist')

@section('content')
<div class="container mt-4">
    <h3>My Wishlist</h3>
    <div class="row">
        @forelse($wishlists as $wishlist)
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{ asset('uploads/products/'.$wishlist->product->product_image) }}" class="card-img-top" height="200">
                    <div class="card-body">
                        <h5>{{ $wishlist->product->product_name }}</h5>
                        <p>₹{{ number_format($wishlist->product->product_price) }}</p>
                        <a href="{{ route('wishlist.remove', $wishlist->product_id) }}" class="btn btn-danger btn-sm">Remove</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No products in wishlist</p>
        @endforelse
    </div>
</div>
@endsection

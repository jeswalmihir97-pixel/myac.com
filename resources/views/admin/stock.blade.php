@extends('Layout.amaster')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Stock Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Product</th>
                <th>Current Stock</th>
                <th>Update Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->product_name }}</td>
                <td>
                    @php
                        $sold = \App\Models\OrderItem::where('product_id', $product->id)
                                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                                ->whereIn('orders.status', ['pending','confirmed','shipped','delivered'])
                                ->sum('order_items.quantity');
                        $availableStock = $product->product_qty - $sold;
                    @endphp
                    {{ $availableStock }}
                </td>
                <td>
                    <form action="{{ route('admin.stock.update', $product->id) }}" method="POST" class="d-flex">
                        @csrf
                        <input type="number" name="quantity" value="{{ $product->product_qty}}" class="form-control mr-2" min="0" required>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

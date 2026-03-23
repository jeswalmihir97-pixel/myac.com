@extends('layout.amaster')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <!-- Total Orders -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary shadow-lg rounded-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fa fa-shopping-cart"></i> Total Orders</h5>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>

    <!-- Available Products -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success shadow-lg rounded-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fa fa-box"></i> Available Products</h5>
                <h3>{{ $availableProducts }}</h3>
            </div>
        </div>
    </div>

    <!-- Available Stock -->
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-warning shadow-lg rounded-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fa fa-warehouse"></i> Available Stock</h5>
                <h3>{{ $availableStock }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card shadow-lg mt-4">
    <div class="card-header">
        <h5 class="mb-0">Recent Orders</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer }}</td>
                        <td>{{ $order->product }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>
                            @if($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No recent orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

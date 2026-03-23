@extends('layout.amaster')

@section('title', 'Add Product')

@section('content')
<div class="card shadow-lg p-4">
    <h4 class="mb-3">Add New Product</h4>

    <!-- Success & Errors -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('admin/save-product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <table class="table table-bordered align-middle">
            <tbody>
                <tr>
                    <th style="width: 200px;">Brand Name</th>
                    <td>
                        <input type="text" name="brand_name" class="form-control" placeholder="Enter brand name" required>
                    </td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter product name" required>
                    </td>
                </tr>
                <tr>
                    <th>Product Image</th>
                    <td>
                        <input type="file" name="product_image" class="form-control" accept="image/*" required>
                    </td>
                </tr>
                <tr>
                    <th>Product Size</th>
                    <td>
                        <input type="text" name="product_size" class="form-control" placeholder="Enter size (e.g. 1.5 Ton / 2 Ton)" required>
                    </td>
                </tr>
                <tr>
                    <th>Product Quantity</th>
                    <td>
                        <input type="number" name="product_qty" class="form-control" min="1" required>
                    </td>
                </tr>
                <tr>
                    <th>Product Details</th>
                    <td>
                        <textarea name="product_details" class="form-control" rows="4" placeholder="Enter details" required></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Product Price</th>
                    <td>
                        <input type="number" name="product_price" class="form-control" min="0" required>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Save Product
            </button>
            <a href="{{ url('admin/dashboard') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

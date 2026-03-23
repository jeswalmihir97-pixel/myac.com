<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom User CSS -->
    <link href="{{ asset('user.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">MYAC.COM</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/orders') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                    </li>
                </ul>

                <!-- Search bar -->
                <form class="d-flex ms-3 me-auto" action="{{ url('user/search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" value="{{ $query ?? '' }}" placeholder="Search products..." aria-label="Search">
                    <button class="btn btn-light" type="submit">Search</button>
                </form>

                <!-- Links -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user/wishlist') }}">
                            Wishlist 
                            <span class="badge bg-light text-dark">{{ $wishlistCount ?? 0 }}</span>
                        </a>
                    </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{ url('/cart') }}">
                            🛒 Cart <span id="cart-count" class="badge bg-danger">{{ collect(session('cart', []))->sum('qty') }}</span>
                       </a>
                     </li>
                </ul>

                <!-- User info -->
                <div class="ms-3">
                    <span class="text-light me-3">
                          {{ session('username', 'Guest') }}
                    </span>
                    <a href="{{ url('logout') }}" class="btn btn-light btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5 shadow-sm">
        <p class="mb-0">&copy; {{ date('Y') }} User Dashboard. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.addToCartBtn', function () {
            let productId = $(this).data('id');
            let qty = $(this).closest('form').find('input[name="qty"]').val();

            $.ajax({
                url: "/cart/add/" + productId,
                type: "POST",
                data: {
                    qty: qty,
                    action: "cart",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    // Update cart count in navbar
                    $('#cart-count').text(response.cartCount);

                    // Optional toast
                    alert(response.message);
                },
                error: function () {
                    alert("Something went wrong!");
                }
            });
        });
        $(document).on('change', '.update-cart', function () {
            let id = $(this).data('id');
            let qty = $(this).val();

            $.ajax({
                url: "/cart/update/" + id,
                type: "POST",
                data: {
                    qty: qty,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        // update subtotal
                        $("#subtotal-" + id).text(response.subtotal.toLocaleString());

                        // update grand total
                        $("#grand-total").text(response.grandTotal.toLocaleString());

                        // update navbar cart count
                        $("#cart-count").text(response.cartCount);
                    }
                }
            });
        });
    </script>
</body>
</html>

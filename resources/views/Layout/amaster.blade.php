<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">Admin Panel</div>
            <div class="list-group list-group-flush">
                <a href="{{ url('admin/dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-home"></i> Dashboard
                </a>
                <a href="{{ url('admin/add-product') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-plus"></i> Add Product
                </a>
                <a href="{{ route('admin.stock') }}" 
                    class="list-group-item list-group-item-action bg-dark text-white {{ request()->is('admin/stock') ? 'active' : '' }}">
                    <i class="fa fa-box"></i> Stock Management
                </a>
                <a href="{{ url('admin/orders') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fa fa-shopping-cart"></i> Orders
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="menu-toggle">☰</button>

                    <!-- Right Side (Admin Icon + Name) -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle fa-lg me-2 text-primary"></i>
                            <span class="fw-bold">
                                {{ session('username') ?? ($user->name ?? 'Admin') }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ url('/logout') }}"><i class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </li>

                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById("menu-toggle").onclick = function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        };
    </script>
</body>
</html>

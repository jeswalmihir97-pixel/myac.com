<!DOCTYPE html>
<html>
<head>
    <title>myac.com Login</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="{{ asset('myac.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-header">
                        myac.com
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger bg-danger text-white">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" name="username" id="uesrname" class="form-control" placeholder="UserName" required autofocus>
                            </div>

                            <div class="form-group mt-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
                        </form>

                        <!-- Register link -->
                        <div class="text-center mt-3">
                            <a href="{{ url('/register') }}">❄️ New user? Register here</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page {{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Gradient Background -->
    <div class="gradient-bg">
        <!-- Canvas for Bubbles -->
        <canvas id="starCanvas"></canvas>
        <!-- Login Form Container -->
        <div class="login-container">
            <div class="card p-4 shadow-lg">
                <h3 class="text-center mb-4">Login</h3>
                <form action="{{ route('login.commit') }}" method="POST">
                  @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('register', ['type' => 'tenant']) }}" class="text-decoration-none">Create an account</a>
                    <br>
                    <a href="{{ route('register', ['type' => 'admin']) }}" class="text-decoration-none">Create Account Operator</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/stareffect.js') }}"></script>
</body>
</html>

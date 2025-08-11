<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://www.pfchangshomemenu.com/sites/g/files/qyyrlu311/files/images/pairings/S3CA0220_PFC_FamilyFeast_084_Hero_LR_r2_0.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 15px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.25),
                -5px -5px 15px rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease-in-out;
        }

        .login-box:hover {
            transform: translateY(-5px);
            box-shadow: 15px 15px 30px rgba(0, 0, 0, 0.3),
                -5px -5px 20px rgba(255, 255, 255, 0.7);
        }

        .login-box h3 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #1e1e2f;
        }

        .input-group-text {
            background: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1e40af;
        }

        .form-control {
            border: 1px solid #93c5fd;
            box-shadow: inset 3px 3px 8px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            border-color: #2563eb;
        }

        .btn-login {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2),
                -2px -2px 5px rgba(255, 255, 255, 0.3);
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <h3>Login</h3>

            <!-- Show error if login fails -->
            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif


            <!-- Validation errors (optional) -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.logincheck') }}" method="POST">
                @csrf

                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-login">Login</button>
                </div>

                <div class="register-link">
                    <p>Don't have an account? <a href="{{ route('user.signup') }}">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

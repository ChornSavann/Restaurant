<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      /* Background image with fixed position and cover */
      background: url('https://www.pfchangshomemenu.com/sites/g/files/qyyrlu311/files/images/pairings/S3CA0220_PFC_FamilyFeast_084_Hero_LR_r2_0.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    .register-box {
      max-width: 450px;
      margin: 80px auto;
      padding: 30px;
      /* Slightly transparent white background so form stands out */
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .input-group-text {
      background: #fff;
      border-right: 0;
    }
    .form-control {
      border-left: 0;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }
  </style>
</head>
<body>

<div class="register-box">
  <h3 class="text-center mb-4">Register</h3>
  <form action="{{route('user.registercheck')}}" method="POST">
    <!-- Laravel CSRF Token -->
    @csrf
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-user"></i>
      </span>
      <input type="text" name="name" class="form-control" placeholder="Full Name" required>
    </div>

    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-envelope"></i>
      </span>
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>

    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-lock"></i>
      </span>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-lock"></i>
      </span>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
    </div>

    <div class="d-grid">
      <button type="submit" name="signup" value="signup" class="btn btn-success">Register</button>
    </div>

    <div class="text-center mt-3">
      Already have an account? <a href="{{route('user.login')}}">Login</a>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

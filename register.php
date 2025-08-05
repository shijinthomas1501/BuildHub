<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - BUILDHUB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('assets/images/register-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      padding: 2rem;
    }

    h2 {
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <h2 class="text-center mb-4">Create Your BUILDHUB Account</h2>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
          <?php endif; ?>

          <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
          <?php endif; ?>

          <form action="includes/auth.php" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Create Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Register as</label>
              <select name="role" class="form-select" required>
                <option value="">Select Role</option>
                <option value="homeowner">Homeowner</option>
                <option value="contractor">Contractor</option>
                <option value="architect">Architect</option>
              </select>
            </div>

            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
          </form>

          <p class="text-center mt-3">
            Already have an account? <a href="login.php">Login here</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

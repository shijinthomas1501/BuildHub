<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BUILDHUB - Smart Construction Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: url('assets/images/construction-bg.jpg') no-repeat center center;
      background-size: cover;
      height: 90vh;
      color: white;
      text-shadow: 2px 2px 4px #000;
    }
    .feature-icon {
      font-size: 40px;
      color: #0d6efd;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">BUILDHUB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero d-flex align-items-center justify-content-center">
  <div class="text-center">
    <h1 class="display-4 fw-bold">Welcome to BUILDHUB</h1>
    <p class="lead">Smart Planning. Smart Estimation. Smart Design.</p>
    <a href="register.php" class="btn btn-primary btn-lg mt-3">Get Started</a>
  </div>
</section>

<!-- Features Section -->
<section class="container my-5">
  <div class="text-center mb-4">
    <h2>Key Features</h2>
    <p class="text-muted">What BUILDHUB offers</p>
  </div>
  <div class="row text-center">
    <div class="col-md-4">
      <div class="feature-icon mb-3">📐</div>
      <h5>Smart Planning</h5>
      <p>Plan your building layout with ease using our guided tools.</p>
    </div>
    <div class="col-md-4">
      <div class="feature-icon mb-3">💰</div>
      <h5>Instant Estimation</h5>
      <p>Get accurate material and labor cost estimation instantly.</p>
    </div>
    <div class="col-md-4">
      <div class="feature-icon mb-3">🧑‍🎨</div>
      <h5>Design Preview</h5>
      <p>Browse templates and visualize your dream project in 2D.</p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-light text-center p-3">
  &copy; 2025 BUILDHUB. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

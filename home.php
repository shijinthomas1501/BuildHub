<?php
session_start();

// Determine user info from either login method
if (isset($_SESSION['user'])) {
    // Normal login
    $name = $_SESSION['user']['name'];
    $email = $_SESSION['user']['email'];
    $picture = null;
} elseif (isset($_SESSION['user_email'])) {
    // Google login
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    $picture = $_SESSION['user_picture'] ?? null;
} else {
    // Not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - BuildHub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      border-radius: 20px;
      transition: 0.3s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .profile-img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    .logout-btn {
      position: absolute;
      top: 20px;
      right: 30px;
    }
  </style>
</head>
<body>

  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="d-flex align-items-center gap-3">
        <?php if ($picture): ?>
          <img src="<?= htmlspecialchars($picture); ?>" alt="Profile" class="profile-img">
        <?php endif; ?>
        <div>
          <h3>Welcome, <?= htmlspecialchars($name); ?> 👷</h3>
          <p class="text-muted mb-0"><?= htmlspecialchars($email); ?></p>
        </div>
      </div>
      <a href="logout.php" class="btn btn-danger logout-btn">Logout <i class="bi bi-box-arrow-right"></i></a>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4 bg-white text-center">
          <i class="bi bi-layout-text-window-reverse fs-2 text-primary mb-2"></i>
          <h5>Project Dashboard</h5>
          <p class="text-muted">View and manage all ongoing construction projects.</p>
          <a href="#" class="btn btn-outline-primary btn-sm">Open Dashboard</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4 bg-white text-center">
          <i class="bi bi-building fs-2 text-success mb-2"></i>
          <h5>My Projects</h5>
          <p class="text-muted">Track your submitted plans and estimations.</p>
          <a href="#" class="btn btn-outline-success btn-sm">View Projects</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4 bg-white text-center">
          <i class="bi bi-bar-chart-line fs-2 text-warning mb-2"></i>
          <h5>Reports</h5>
          <p class="text-muted">Download construction analytics and progress reports.</p>
          <a href="#" class="btn btn-outline-warning btn-sm">View Reports</a>
        </div>
      </div>
    </div>

    <div class="text-center mt-5 text-muted">
      <small>© <?= date('Y'); ?> BuildHub - Smart Construction Assistant</small>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

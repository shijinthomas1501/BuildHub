<?php
session_start();

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['name'];
    $email = $_SESSION['user']['email'];
    $picture = null;
} elseif (isset($_SESSION['user_email'])) {
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    $picture = $_SESSION['user_picture'] ?? null;
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BuildHub Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap & Icons -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', sans-serif;
    }

    .header-bar {
      background-color: #0077b6;
      color: white;
      padding: 20px 30px;
      border-radius: 0 0 15px 15px;
    }

    .profile-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #fff;
    }

    .card {
      border: none;
      border-radius: 16px;
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .logout-btn {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }

    .logout-btn:hover {
      text-decoration: underline;
    }

    footer {
      margin-top: 50px;
      text-align: center;
      color: #aaa;
    }
  </style>
</head>
<body>

  <!-- Top Header -->
  <div class="header-bar d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
      <?php if ($picture): ?>
        <img src="<?= htmlspecialchars($picture); ?>" class="profile-img" alt="Profile">
      <?php else: ?>
        <i class="bi bi-person-circle fs-1"></i>
      <?php endif; ?>
      <div>
        <h4 class="mb-0">Hello, <?= htmlspecialchars($name); ?> 👷</h4>
        <small><?= htmlspecialchars($email); ?></small>
      </div>
    </div>
    <a href="logout.php" class="logout-btn"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
  </div>

  <!-- Dashboard Cards -->
  <div class="container my-5">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-columns-gap text-primary fs-1 mb-2"></i>
          <h5 class="fw-bold">Project Planner</h5>
          <p>Manage construction plans, timelines, and budgeting.</p>
          <a href="#" class="btn btn-outline-primary btn-sm">Open Planner</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-pencil-ruler text-success fs-1 mb-2"></i>
          <h5 class="fw-bold">Design Studio</h5>
          <p>Create or upload blueprints and get instant suggestions.</p>
          <a href="#" class="btn btn-outline-success btn-sm">Start Designing</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-graph-up text-warning fs-1 mb-2"></i>
          <h5 class="fw-bold">Estimation Tool</h5>
          <p>Auto-generate cost estimations based on material rates.</p>
          <a href="#" class="btn btn-outline-warning btn-sm">Estimate Now</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-truck text-danger fs-1 mb-2"></i>
          <h5 class="fw-bold">Delivery Tracker</h5>
          <p>Track site deliveries and manage logistics providers.</p>
          <a href="#" class="btn btn-outline-danger btn-sm">Track Delivery</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-people text-info fs-1 mb-2"></i>
          <h5 class="fw-bold">Contractor Connect</h5>
          <p>Find & manage workers, vendors and contractors.</p>
          <a href="#" class="btn btn-outline-info btn-sm">View Contractors</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm p-4 text-center bg-white">
          <i class="bi bi-pie-chart-fill text-secondary fs-1 mb-2"></i>
          <h5 class="fw-bold">Reports & Analytics</h5>
          <p>Download project progress, costs, and site analytics.</p>
          <a href="#" class="btn btn-outline-secondary btn-sm">Generate Reports</a>
        </div>
      </div>

    </div>
  </div>

  <footer>
    <small>© <?= date("Y"); ?> BuildHub – Smart Construction Assistant</small>
  </footer>

  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

// Use default profile picture if not set or empty
if (!isset($user['picture']) || empty($user['picture'])) {
    $user['picture'] = '../assets/img/default_profile.png';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - BuildHub</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    .welcome {
      background: linear-gradient(135deg, #007bff, #00c6ff);
      color: white;
      border-radius: 1rem;
      padding: 30px;
    }
    .profile-pic {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }
  </style>
</head>
<body>

<div class="container py-4">
  <!-- Welcome -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between welcome">
        <div class="d-flex align-items-center">
          <img src="<?= htmlspecialchars($user['picture']) ?>" alt="Profile" class="profile-pic">
          <div>
            <h4 class="mb-0">Welcome, <?= htmlspecialchars($user['name']) ?> 👷‍♂️</h4>
            <p class="mb-0">Ready to build something great today?</p>
          </div>
        </div>
        <a href="../logout.php" class="btn btn-light">Logout</a>
      </div>
    </div>
  </div>

  <!-- Dashboard Cards -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="fas fa-building fa-2x text-primary mb-2"></i>
        <h5>My Projects</h5>
        <p>View and manage all your construction projects.</p>
        <a href="#" class="btn btn-outline-primary btn-sm">View Projects</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="fas fa-calculator fa-2x text-success mb-2"></i>
        <h5>Estimation Tools</h5>
        <p>Access budget and material estimators.</p>
        <a href="#" class="btn btn-outline-success btn-sm">Start Estimation</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="fas fa-drafting-compass fa-2x text-danger mb-2"></i>
        <h5>Design Plans</h5>
        <p>Upload and review architectural blueprints.</p>
        <a href="#" class="btn btn-outline-danger btn-sm">Manage Designs</a>
      </div>
    </div>
  </div>

  <!-- Upcoming Section -->
  <div class="row mt-5">
    <div class="col-md-6">
      <div class="card p-4">
        <h5 class="mb-3"><i class="fas fa-tasks text-warning"></i> Upcoming Tasks</h5>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">📌 Finalize budget estimate for Apartment Project</li>
          <li class="list-group-item">📌 Site inspection for Villa at Site-2</li>
          <li class="list-group-item">📌 Upload electrical layout designs</li>
        </ul>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4">
        <h5 class="mb-3"><i class="fas fa-link text-info"></i> Quick Access</h5>
        <div class="d-grid gap-2">
          <a href="#" class="btn btn-outline-secondary">Create New Project</a>
          <a href="#" class="btn btn-outline-secondary">Track Materials</a>
          <a href="#" class="btn btn-outline-secondary">Generate Invoice</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

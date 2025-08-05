<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Contractor') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contractor Dashboard - BUILDHUB</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background: #212529;
      color: #fff;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background: #343a40;
    }
    .main {
      flex-grow: 1;
      padding: 30px;
      background: #f1f3f5;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h4 class="text-center">🛠️ Contractor</h4>
    <hr>
    <a href="#">Dashboard</a>
    <a href="#">Assigned Projects</a>
    <a href="#">Progress Updates</a>
    <a href="#">Material Requests</a>
    <a href="#">Workforce</a>
       <a href="../logout.php" class="btn btn-outline-danger float-end">Logout</a>

  </div>
  <div class="main">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> 🧱</h2>
    <p class="lead">Manage construction projects and workforce efficiently.</p>
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Projects In Progress</h5>
            <p>5 projects currently under work</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Material Stock Requests</h5>
            <p>3 pending approvals</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'homeowner') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Homeowner Dashboard - BUILDHUB</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background: #343a40;
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
      background: #495057;
    }
    .main {
      flex-grow: 1;
      padding: 30px;
      background: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h4 class="text-center">🏗️ BUILDHUB</h4>
    <hr>
    <a href="#">Dashboard</a>
    <a href="#">My Projects</a>
    <a href="#">Request Estimate</a>
    <a href="#">Find Architect</a>
    <a href="#">Track Progress</a>
   <!-- Inside dashboard/architect_home.php -->
<a href="../logout.php" class="btn btn-outline-danger float-end">Logout</a>

  </div>
  <div class="main">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> 👋</h2>
    <p class="lead">Manage your home construction & renovation smartly.</p>
    <div class="row">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Active Projects</h5>
            <p>2 ongoing, 1 completed</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Pending Estimates</h5>
            <p>Waiting from 2 architects</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

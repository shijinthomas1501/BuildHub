<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'rchitect') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Architect Dashboard - BUILDHUB</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background: #0d6efd;
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
      background: #0b5ed7;
    }
    .main {
      flex-grow: 1;
      padding: 30px;
      background: #eef1f5;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h4 class="text-center">🏛️ Architect</h4>
    <hr>
    <a href="#">Dashboard</a>
    <a href="#">Design Requests</a>
    <a href="#">Project Plans</a>
    <a href="#">Client Meetings</a>
    <a href="#">3D Visuals</a>
   <a href="../logout.php" class="btn btn-outline-danger float-end">Logout</a>
  </div>
  <div class="main">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> 🏛️</h2>
    <p class="lead">Design smarter structures and collaborate effectively.</p>
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Pending Design Requests</h5>
            <p>You have 4 pending plans to submit</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Meetings Scheduled</h5>
            <p>2 with homeowners this week</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php
// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/google_config.php'; // Ensure this file exists

// If already logged in, redirect based on role
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    switch ($role) {
        case 'homeowner':
            header('Location: dashboard/homeowner_home.php');
            break;
        case 'contractor':
            header('Location: dashboard/contractor_home.php');
            break;
        case 'architect':
            header('Location: dashboard/architect_home.php');
            break;
        default:
            header('Location: dashboard/user_home.php');
    }
    exit;
}

// Handle Google OAuth Callback
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!is_array($token) || isset($token['error'])) {
        $_SESSION['error'] = 'Google Login failed.';
        header("Location: login.php");
        exit;
    }

    $client->setAccessToken($token['access_token']);
    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    require_once 'includes/db.php';
    $email = $userInfo->email;

    if ($conn instanceof PDO) {
        $stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $role = $row ? $row['role'] : null;
    } else {
        $stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $role = $row ? $row['role'] : null;
    }

    if (!$role) {
        $_SESSION['error'] = "No account linked to this Google email.";
        header("Location: login.php");
        exit;
    }

    $_SESSION['user'] = [
        'name' => $userInfo->name,
        'email' => $userInfo->email,
        'role' => $role,
        'picture' => $userInfo->picture
    ];

    switch ($role) {
        case 'homeowner':
            header("Location: dashboard/homeowner_home.php");
            break;
        case 'contractor':
            header("Location: dashboard/contractor_home.php");
            break;
        case 'architect':
            header("Location: dashboard/architect_home.php");
            break;
        default:
            header("Location: dashboard/user_home.php");
    }
    exit;
}

$google_login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - BUILDHUB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('assets/images/login-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }
    .card-body {
      padding: 2rem;
    }
    .btn-google {
      background-color: #db4437;
      color: white;
    }
    .btn-google:hover {
      background-color: #c23321;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card">
          <div class="card-body">
            <h3 class="text-center mb-4">Login to <span class="text-primary">BUILDHUB</span></h3>

            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <form action="includes/auth.php" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <div class="form-text text-end mb-3">
                <a href="forgot_password.php">Forgot Password?</a>
              </div>

              <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-4">
              <p>Or sign in with</p>
              <a href="<?= htmlspecialchars($google_login_url) ?>" class="btn btn-google w-100">
                <i class="fab fa-google me-2"></i> Sign in with Google
              </a>
            </div>

            <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

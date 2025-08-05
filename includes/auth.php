<?php
session_start();
require_once 'db.php'; // Database connection
require_once 'includes/google_config.php'; // Google OAuth configuration

// If already logged in, redirect to correct dashboard
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    switch ($role) {
        case 'Admin':
            header('Location: dashboard/admin.php');
            exit;
        case 'Contractor':
            header('Location: dashboard/contractor_home.php');
            exit;
        case 'Architect':
            header('Location: dashboard/architect_home.php');
            exit;
        default:
            header('Location: dashboard/homeowner_home.php');
            exit;
    }
}

// ---------------- EMAIL/PASSWORD LOGIN ----------------
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            if ($user['is_verified'] == 0 && ($user['role'] === 'Contractor' || $user['role'] === 'Architect')) {
                $_SESSION['error'] = "Account not yet verified by admin.";
                header('Location: login.php');
                exit;
            }

            $_SESSION['user'] = $user;

            switch ($user['role']) {
                case 'Admin':
                    header('Location: dashboard/admin.php');
                    break;
                case 'Contractor':
                    header('Location: dashboard/contractor_home.php');
                    break;
                case 'Architect':
                    header('Location: dashboard/architect_home.php');
                    break;
                default:
                    header('Location: dashboard/homeowner_home.php');
            }
            exit;
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "No account found with that email.";
    }

    header('Location: login.php');
    exit;
}

// ---------------- GOOGLE OAUTH LOGIN ----------------
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $client->setAccessToken($token);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account = $google_oauth->userinfo->get();

        $email = $google_account->email;
        $name = $google_account->name;

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            // Register new user as Homeowner
            $role = 'Homeowner';
            $is_verified = 1;
            $password = ''; // Not used for Google

            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, is_verified) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $name, $email, $password, $role, $is_verified);
            $stmt->execute();

            $user_id = $stmt->insert_id;
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        }

        $_SESSION['user'] = $user;

        switch ($user['role']) {
            case 'Admin':
                header('Location: dashboard/admin.php');
                break;
            case 'Contractor':
                header('Location: dashboard/contractor_home.php');
                break;
            case 'Architect':
                header('Location: dashboard/architect_home.php');
                break;
            default:
                header('Location: dashboard/homeowner_home.php');
        }
        exit;
    } else {
        $_SESSION['error'] = "Google authentication failed.";
        header('Location: login.php');
        exit;
    }
}
?>

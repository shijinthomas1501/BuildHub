<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>
<?php
if (isset($_SESSION['error'])) {
    echo "<div style='color:red'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
$token = $_GET['token'] ?? '';
?>
<form method="POST" action="includes/auth.php">
    <input type="hidden" name="action" value="reset_password">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <br>
    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" required>
    <br>
    <button type="submit">Reset Password</button>
</form>
</body>
</html>

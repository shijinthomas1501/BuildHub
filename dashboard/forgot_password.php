<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
<h2>Forgot Password</h2>
<?php
if (isset($_SESSION['success'])) {
    echo "<div style='color:green'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<div style='color:red'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>
<form method="POST" action="includes/auth.php">
    <input type="hidden" name="action" value="forgot_password">
    <label>Email:</label>
    <input type="email" name="reset_email" required>
    <button type="submit">Send Reset Link</button>
</form>
</body>
</html>

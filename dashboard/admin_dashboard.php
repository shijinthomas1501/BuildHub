<?php
session_start();
require_once 'includes/db.php';

// Only allow admin access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Handle approval/rejection actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $stmt = $conn->prepare("UPDATE users SET is_verified = 'Approved' WHERE id = ?");
    } elseif ($action === 'reject') {
        $stmt = $conn->prepare("UPDATE users SET is_verified = 'Rejected' WHERE id = ?");
    }

    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $_SESSION['success'] = "User verification updated.";
    }
    header("Location: admin_verification.php");
    exit();
}

// Fetch unverified contractors/architects
$query = "SELECT * FROM users WHERE role IN ('Contractor', 'Architect') AND is_verified = 'Pending'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Contractor/Architect - Admin | BUILDHUB</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ccc; }
        h2 { margin-bottom: 20px; }
        .success { color: green; }
        iframe { width: 100%; height: 300px; border: none; }
        form { display: inline; }
        .btn { padding: 6px 12px; margin: 2px; }
        .approve { background-color: #4CAF50; color: white; }
        .reject { background-color: #f44336; color: white; }
    </style>
</head>
<body>

<h2>Admin Verification Panel</h2>

<?php if (isset($_SESSION['success'])): ?>
    <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Qualification Document</th>
        <th>Action</th>
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <?php if (!empty($row['qualification_doc'])): ?>
                        <iframe src="uploads/qualifications/<?= htmlspecialchars($row['qualification_doc']) ?>"></iframe>
                    <?php else: ?>
                        No file uploaded
                    <?php endif; ?>
                </td>
                <td>
                    <form method="POST" action="admin_verification.php">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                        <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No users pending verification.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include("header.php"); ?>

<div class="container mt-5 text-center" style="max-width:400px;">
    <h3 class="mb-4">Account Settings</h3>

    <div class="d-grid gap-3">
        <a href="updatepassword.php" class="btn btn-primary btn-lg">🔑 Update Password</a>
        <a href="updateskills.php" class="btn btn-info btn-lg text-white">🛠️ Update Skills</a>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-lg">← Back to Dashboard</a>
    </div>
</div>

<?php include("footer.php"); ?>
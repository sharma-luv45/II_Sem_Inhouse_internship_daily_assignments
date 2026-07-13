<?php
session_start();
include("db_connect.php");

// Redirect if not logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = isset($_POST['oldpassword']) ? $_POST['oldpassword'] : "";
    $newPassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : "";
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : "";

    if ($oldPassword == "" || $newPassword == "" || $confirmPassword == "") {
        $error = "All fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New passwords do not match.";
    } else {
        $email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
        $query = "SELECT password FROM user WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($oldPassword, $row['password'])) {
                $hashedNew = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE user SET password='$hashedNew' WHERE email='$email'";
                if (mysqli_query($conn, $updateQuery)) {
                    $success = "Password updated successfully!";
                } else {
                    $error = "Failed to update password. Try again.";
                }
            } else {
                $error = "Old password is incorrect.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5" style="max-width:400px;">
    <form action="updatepassword.php" method="POST">
        <h3 class="mb-3">Update Password</h3>

        <?php if ($error != ""): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success != ""): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <input type="password" name="oldpassword" class="form-control mb-3" placeholder="Old Password" required>
        <input type="password" name="newpassword" class="form-control mb-3" placeholder="New Password" required>
        <input type="password" name="confirmPassword" class="form-control mb-3" placeholder="Confirm Password" required>
        <button type="submit" class="btn btn-primary w-100">Update Password</button>

        <p class="text-center mt-3">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </form>
</div>

<?php include("footer.php"); ?>
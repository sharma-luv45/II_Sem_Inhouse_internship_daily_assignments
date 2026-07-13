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
    $skills = isset($_POST['skills']) ? mysqli_real_escape_string($conn, $_POST['skills']) : "";

    if ($skills == "") {
        $error = "Please enter your skills.";
    } else {
        $email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
        $updateQuery = "UPDATE user SET skills='$skills' WHERE email='$email'";

        if (mysqli_query($conn, $updateQuery)) {
            $success = "Skills updated successfully!";
        } else {
            $error = "Failed to update skills. Try again.";
        }
    }
}

// Fetch current skills
$currentSkills = "";
if (isset($_SESSION['user_email'])) {
    $email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
    $query = "SELECT skills FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentSkills = $row['skills'] ? $row['skills'] : "";
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5" style="max-width:400px;">
    <form action="updateskills.php" method="POST">
        <h3 class="mb-3">Update Skills</h3>

        <?php if ($error != ""): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success != ""): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <textarea name="skills" class="form-control mb-3" rows="4" placeholder="Enter your skills (e.g. HTML, CSS, JavaScript, PHP...)" required><?php echo htmlspecialchars($currentSkills); ?></textarea>
        <button type="submit" class="btn btn-primary w-100">Update Skills</button>

        <p class="text-center mt-3">
            <a href="dashboard.php">← Back to Dashboard</a>
        </p>
    </form>
</div>

<?php include("footer.php"); ?>
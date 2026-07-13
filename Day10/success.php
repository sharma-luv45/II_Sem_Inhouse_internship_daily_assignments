<?php
session_start();
?>

<?php include("header.php"); ?>

<div class="container mt-5 text-center">
    <div class="alert alert-success">
        <h3>Registration Successful! 🎉</h3>
        <p>Your form has been submitted successfully.</p>
        <div style="font-size: 2rem;">💃💃💃</div>
    </div>
    <a href="dashboard.php" class="btn btn-success me-2">Go to Dashboard</a>
    <a href="registration.php" class="btn btn-primary">Go back</a>
</div>

<?php include("footer.php"); ?>
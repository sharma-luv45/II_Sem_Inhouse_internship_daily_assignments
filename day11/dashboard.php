<?php
session_start();

include('dashboardheader.php');

// Check if user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container-fluid mt-4">
    <div class="row">

        <!-- Left Side -->
        <div class="col-md-3">
            <div class="sidebar">
                <h4>Dashboard</h4>

                <a href="updatepassword.php" class="menu-btn">
                    Update Password
                </a>

                <a href="logout.php" class="menu-btn logout">
                    Logout
                </a>
            </div>
        </div>

        <!-- Right Side -->
        <div class="col-md-9">
            <div class="welcome-box">
                <h2>
                    Welcome, <?php echo $_SESSION['user_name']; ?>!
                </h2>

                <p>You have successfully logged in.</p>
            </div>
        </div>

    </div>
</div>

<?php
include('footer.php');
?>
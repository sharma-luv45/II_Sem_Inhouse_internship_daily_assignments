<?php
session_start();
include('dc_connect.php');
include('header.php');

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

if(isset($_POST['update'])){

    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $sql = "UPDATE users
            SET user_name='$name',
                email='$email',
                mobile='$mobile'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql)){
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        echo "<div class='alert alert-success'>Profile Updated Successfully.</div>";
    }else{
        echo "<div class='alert alert-danger'>Error updating profile.</div>";
    }
}

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<div class="container mt-5" style="max-width:500px;">
    <h3>Update Profile</h3>

    <form method="post">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="user_name" class="form-control"
            value="<?php echo $row['user_name']; ?>">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
            value="<?php echo $row['email']; ?>">
        </div>

        <div class="mb-3">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control"
            value="<?php echo $row['mobile']; ?>">
        </div>

        <button type="submit" name="update" class="btn btn-primary">
            Update Profile
        </button>

    </form>
</div>

<?php include('footer.php'); ?>
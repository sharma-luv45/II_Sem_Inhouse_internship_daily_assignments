<?php
$error = "";

$confirmpassword = "";
$newpassword = "";
$oldpassword = "";

include('dc_connect.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $oldpassword = mysqli_real_escape_string($conn, $_POST["oldpassword"]);
    $Newpassword = mysqli_real_escape_string($conn, $_POST["newpassword"]);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);

    if ($newpassword == "" || $oldpassword == "" || $confirmpassword = "") {
        $error = "All fields are required.";     
    }
    elseif($newpassword != $confirmpassword){
        $error = "Password does not match";
    }
     else {
        $updateQuery = "update user set password = '$password'  where id =  $_SESSION['user_id'] = $user['id']";

        $result = mysqli_query($conn, $selectQuery);
        $user = mysqli_fetch_assoc($result);

        if($user && $user['password'] == $oldpassword){

            header("Location: updatesuccess.php");
            exit();
        }
        elseif($user){
            echo "Old Password does not matched";
        }
        else{
            echo "Invalid Credentials";
        }
        
    }
}
?>
<?php
include("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if (empty($name) || empty($email) || empty($password) || empty($confirmpassword)) {
        die("All fields are required.");
    }

    if ($password != $confirmpassword) {
        die("passwords do not match.");
    }

    $sql = "INSERT INTO user (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
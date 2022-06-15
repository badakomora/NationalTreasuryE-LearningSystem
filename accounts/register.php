<?php
    if (isset($_POST['submit'])) {
   
    include '../includes/config.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $users = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND username = '$username'");
    $rows = mysqli_num_rows($users);
    if($rows >= 1){
        $msg = "User ALready Exists. Please use a different email and username to sign Up.";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        header("refresh: 0, ../"); 
    }else{
        $insert = mysqli_query($con, "INSERT INTO users(firstname, lastname, username, email, password) VALUES(' $firstname', '$lastname', '$username', '$email', '$password')");
        $msg = "Registration Successful! You can Sign In Now.";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        header("refresh: 0, ../"); 
    }

}
?>
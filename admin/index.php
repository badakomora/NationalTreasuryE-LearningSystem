<?php
session_start();
include '../includes/config.php';
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $msg = '';

  $query = mysqli_query($con, "SELECT * FROM admin where email = '$email' AND password = '$password'");
  $row = mysqli_fetch_assoc($query);
  if ($row >= 1) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['profile'] = $row['profile'];

    header('refresh: 0, ../?q=AdminDashboard');
    $msg = "Admin Login Access Granted.";
    echo "<script type='text/javascript'>alert('$msg');</script>";
  } else {

    header('refresh: 0, ./');
    $msg = "Admin Login Access Denied. Please use the correct credentials";
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="top-header">
      <h3>Admin Sign In</h3>
      <p>Enter your credentials to access your account</p>
    </div>
    <form action="" method="POST">
      <div class="user">
        <i class="bx bxs-user-circle"></i>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="pass">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="btn">
        <button type="submit" name="submit">Sign in</button>
      </div>
    </form>

  </div>
  <!-- <p class="last">Forgot your password? <a href="#"> Reset Password </a></p> -->
  <!-- <script src="/app.js"></script> -->
</body>

</html>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: poppins;
  }

  body {
    background-color: #f2f4ff;
  }

  .container {
    width: 400px;
    height: 300px;
    background-color: #fff;
    margin: 150px auto;
    border-radius: 11px;
    padding: 40px 50px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
  }

  /* top-header */
  .top-header h3 {
    text-align: center;
    color: #495d76;
  }

  .top-header p {
    color: #cecfd3;
    font-size: 13px;
    text-align: center;
    margin-top: 5px;
  }

  /* top-header */
  /* form */
  .user input,
  .pass input {
    width: 100%;
    height: 35px;
    border: none;
    border: 1px solid #e6e6e6;
    border-radius: 6px;
    outline: none;
    padding: 0 40px;
  }

  ::placeholder {
    color: #9ca5b4;
    font-size: 12px;
  }

  .user i,
  .pass i {
    position: relative;
    top: 31px;
    right: -10px;
    color: #3981ed;
  }

  /* form */
  /* button */
  .btn {
    display: flex;
    justify-content: center;
    margin-top: 25px;
  }

  .btn button {
    width: 100%;
    border: none;
    height: 35px;
    background-color: #277ffd;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
  }

  /* button */
  p.last {
    text-align: center;
    position: relative;
    bottom: 120px;
    font-size: 12px;
  }
</style>
<?php
session_start();
include_once '../includes/config.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];

    $result = mysqli_query($con, "SELECT * FROM users WHERE username='$name' AND email = '$email'");
    $num = mysqli_num_rows($result);
    if ($num >= 1) {
        $row = mysqli_fetch_array($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="tools/styles.css">
            <title>Learn</title>
        </head>

        <body>
            <p style="color: green;">Here is your Password: <?php echo $row['password']; ?></p>
        <?php
    } else { ?>
            <p style="color:red;">Invalid credentials!Please contact your faculty admin for password reset within 24hours!</p>
    <?php }
}
    ?>
    <div class="container p-5">
        <form action="" method="post">
            <div class="input-group">
                <label>Enter registered Email and Username</label>
                <br>
                <input type="email" name="email" class="form-control" placeholder="email" required>
                <br>
                <input type="text" name="name" class="form-control" placeholder="username" required>
                <br>
                <button type="submit" name="submit" style="background-color: #1D2231; color:white; border:none;width:120px; height:40px;">Submit</button>
                <a href="../">go back</a>
            </div>
        </form>
    </div>
        </body>

        </html>
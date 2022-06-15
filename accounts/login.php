
    <?php
    session_start();
    if (isset($_POST['submit'])) {
   
    include '../includes/config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $msg = '';
    $sql = mysqli_query($con, "SELECT * FROM users where email='$email' and password='$password'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $_SESSION["email"] = $row["email"];
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["lastname"] = $row["lastname"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["profile"] = $row["profile"];
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["staff"] = $row["staff"];
        
        if($row['staff'] == '2'){
            
            header("refresh: 0, ../");  
            $msg = "Account Has been De-activated! Please Contact Your Faculty Administrator for more Information.";
            echo "<script type='text/javascript'>alert('$msg');</script>";
            
        
        }else{
            
            header("refresh: 0, ../?q=Dashboard");
            $msg = "Sign In Access Granted!";
            echo "<script type='text/javascript'>alert('$msg');</script>";
            
        }


    }else{

        header("refresh: 0,../");
        $msg = "User Does not Exist! Please Register First.";
        echo "<script type='text/javascript'>alert('$msg');</script>";
        
    }
}
?>
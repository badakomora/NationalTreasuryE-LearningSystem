<?php include("header.php");?>
<main>

<?php if (isset($_GET['q']) AND $_GET['q'] == 'DeleteDepartment'){?>



<?php
$id = $_GET['id'];
$query = mysqli_query($con, "DELETE FROM departments WHERE id ='$id'");
    if($query){
        $msg = "Department Deleted Successfully!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminDepartments';
            </script>";
        
    }else{
        $msg = "An Error ocuured! This Department has courses with records! First you need to delete all the records in this department to allow delete of this department.";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminDepartments';
            </script>";
    }
?>




<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'DeleteUser'){?>




<?php
$user_id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM users where id = $user_id");
    if($query){
    mysqli_query($con, "DELETE FROM mycourses where user_id = $user_id");
    mysqli_query($con, "DELETE FROM lessons_learnt where user_id = $user_id");
    $msg = "User has been Deleted Successfully!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminUsers';
            </script>";
    }else{
    $msg = "An Error ocuured!.";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminUsers';
            </script>";
    
    }

?>




<?php }else{
     $msg = "An Error ocuured! Please try again!";
     echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminDashboard';
            </script>";
 }?>
</main>
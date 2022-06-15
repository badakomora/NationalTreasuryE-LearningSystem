<?php include("header.php");?>
<main>

<?php if (isset($_GET['q']) AND $_GET['q'] == 'DeleteCourse'){?>

<?php
$id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM courses where id ='$id'");
    if($query){
        $msg = "Course Deleted Successfully!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Courses';
            </script>";
        
    }else{
        $msg = "An Error ocuured! This Course has records!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Courses';
            </script>";
    }
?>



<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'DeleteLesson'){?>



<?php
$id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM lessons where id ='$id'");
    if($query){
        $msg = "Lesson Deleted Successfully!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Lessons';
            </script>";
    }else{
        $msg = "An Error ocuured! Please try again!!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Lessons';
            </script>";
    }
?>



<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'DeleteAssignment'){?>



<?php
$lid = $_GET['lid'];
$id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM assignments where id ='$id'");
if($query){
    $msg = "Question Deleted Successfully!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=ViewQuestions&id=$lid';
            </script>";
}else{
    $msg = "An Error ocuured! Please try again";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=ViewQuestions&id=$lid';
            </script>";
}
?>



<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'DeleteExamination'){?>



<?php
$cid = $_GET['cid'];
$id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM final_exam where id ='$id'");
if($query){
    $msg = "Question Deleted Successfully!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=ViewExamination&course=$cid';
            </script>";
}else{
    $msg = "An Error ocuured! Please try again!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=ViewExamination&course=$cid';
            </script>";
}
?>



<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'DeleteUserDetails'){?>


<?php
$course = $_GET['course'];
$id = $_GET['id'];
$query =mysqli_query($con, "DELETE FROM mycourses where user_id = $id and course_id =$course");
if($query){
    mysqli_query($con, "DELETE FROM lessons_learnt where user_id = $id and course_id =$course");
    $msg = "User Deleted Successfully From This Faculty!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Users';
            </script>";
}else{
    $msg = "An Error ocuured!";
    echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Users';
            </script>";
}
?>

<?php }else{
     $msg = "An Error ocuured! Please try again!";
     echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Dashboard';
            </script>";
 }?>
</main>
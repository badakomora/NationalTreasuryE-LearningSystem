<?php 
    $course_id = $_GET['courseid'];
    $user_id = $_SESSION['user_id'];
    $course_name = $_GET['coursename'];
    $status = 2;

    $sql = "SELECT * FROM mycourses WHERE course_id = '$course_id' AND user_id = '$user_id'";
    $result = mysqli_query($con, $sql);

    $numrow = mysqli_num_rows($result);
    if($numrow >= 1){

    }else{
        $msg = "You have successfully enrolled to $course_name";
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    if(!$row = mysqli_fetch_assoc($result)){
        $query = mysqli_query($con, "INSERT INTO mycourses(course_id, user_id, status) VALUE('$course_id', '$user_id', '$status')");

        $sql = "SELECT * FROM lessons WHERE course_id = '$course_id'";
        $result = mysqli_query($con, $sql);

        if($row = mysqli_fetch_assoc($result)){
            $lesid = $row['id'];
           
            $s = mysqli_query($con, "SELECT * FROM lessons_learnt where user_id = '$user_id'  AND lesson_id ='$lesid'");
            $num = mysqli_num_rows($s);
            if($num >= 1){
                echo '';
            }else{
                $sql = "INSERT INTO lessons_learnt(user_id, lesson_id) VALUES ('$user_id', '$lesid')";
                $query = mysqli_query($con, $sql);
            }
         
        }
    }

?>
<?php
    session_start();
    include_once 'includes/config.php';
    if(isset($_POST['submit'])){
    
        $ans = $_POST['answer'];
    
        $user_id = $_SESSION['user_id'];
        $id = $_POST['id'];
    
    
        $correct = 0;
        $wrong = 0;
        $i = 1;   
    
    
    //work out user results
            if(isset($_POST['answer'])){
                for($i=1; $i<=sizeof($_POST['answer']); $i++){
                $res = mysqli_query($con, " SELECT *
                FROM final_exam
                INNER JOIN courses ON final_exam.course_id=courses.id WHERE final_exam.course_id = $id");
                while($row = mysqli_fetch_array($res)){
    
                    if(isset($_POST['answer'][$i])){
                        if($row['answer'] == $_POST['answer'][$i]){
                            $correct++;
                        }else{
                            $wrong++;
                        }
                    }else{
                        $wrong++;
                    }
                    $i++;
                  }    
                }
              }   
              
             
              $count = 0;
              $res = mysqli_query($con,"SELECT *
              FROM final_exam
              INNER JOIN courses ON final_exam.course_id=courses.id WHERE final_exam.course_id = $id");
              $count = mysqli_num_rows($res);
              $wrong = $count - $correct;
              $score = 0;
              $score = ($correct/$count)*100;


              $select = mysqli_query($con, "SELECT * FROM final_results WHERE course_id = '$id' AND user_id = '$user_id'");
              $num = mysqli_num_rows($select);
              if($num >= 1){
              echo '<center><p style="color:Red;">You have already attempted this Test!</p></center>';
                echo '<center><a href="./?q=Dashboard">Home</a></center>';
              }else{
              $no = 1;
              $status = 1;
              //insert user results into results table
              mysqli_query($con, "INSERT INTO final_results(user_id, course_id, marks, status) VALUES('$user_id', '$id', '$score', '$no') ");
              mysqli_query($con, "UPDATE mycourses SET status = '$status' WHERE course_id='$id' AND user_id='$user_id'");
              $msg = "You have successfully completed this Course! Check your performance on your progress. Well Done!";
              echo "<script type='text/javascript'>alert('$msg');</script>";
              header("refresh: 0, ./?q=Progress");
            } 
          }
?>
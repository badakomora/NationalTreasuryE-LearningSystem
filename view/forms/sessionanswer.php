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
                $res = mysqli_query($con, " SELECT lessons.id, assignments.lesson_id, assignments.answer
                FROM lessons
                INNER JOIN assignments ON assignments.lesson_id = lessons.id WHERE assignments.lesson_id = $id");
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
              $res = mysqli_query($con,"SELECT lessons.id, assignments.lesson_id, assignments.answer
              FROM lessons
              INNER JOIN assignments ON assignments.lesson_id = lessons.id WHERE assignments.lesson_id = $id");
              $count = mysqli_num_rows($res);
              $wrong = $count - $correct;
              $score = 0;
              $score = ($correct/$count)*100;


              $select = mysqli_query($con, "SELECT * FROM results WHERE lesson_id = '$id' AND user_id = '$user_id'");
              $num = mysqli_num_rows($select);
              if($num >= 1){
                echo '<center><p style="color:Red;">You have already attempted this Assignment!</p></center>';
                echo '<center><a href="./?q=Dashboard">Home</a></center>';
              }else{
              $no = 1;
              $status = 2;
              //insert user results into results table
              mysqli_query($con, "INSERT INTO results(user_id, lesson_id, marks, attempt) VALUES('$user_id', '$id', '$score', '$no') ");
              mysqli_query($con, "UPDATE assignments_done SET status = '$status' WHERE user_id = '$user_id' AND lesson_id = '$id'");
              $msg = "You have successfully completed this Lesson! Check your performance on your progress. Next Lesson is now accessible. Well Done!";
              echo "<script type='text/javascript'>alert('$msg');</script>";
              header("refresh: 0, ./?q=Progress");
            }    
          
          
          
          
          }
?>
<?php require_once("header.php");?>
<main>



<?php 
$USER = mysqli_query($con, "SELECT departments.id as did, departments.department, faculty.user_id, faculty.d_id, users.id
FROM users
INNER JOIN faculty ON faculty.user_id = users.id
INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
while($row = mysqli_fetch_array($USER)){
  $assignments=mysqli_query($con, "SELECT final_exam.id as feid,final_exam.question, final_exam.course_id, courses.id, courses.d_id, departments.id
  FROM  final_exam
  INNER JOIN courses ON courses.id=final_exam.course_id
  INNER JOIN departments ON departments.id=courses.d_id WHERE courses.d_id='".$row['did']."' AND final_exam.course_id='".$_GET['course']."'");
  $no = 1;
    if(mysqli_num_rows($assignments) >= 1){
  while($assign=mysqli_fetch_array($assignments)){?>
<div style="display:flex; justify-content:space-between;background-color:white;padding:10px;">
                      <p class="show-read-more"><?php echo $assign['question']; ?></p>
                      <div style="display:flex; justify-content:space-around;">
                        <a href="./?q=UpdateExamination&id=<?php echo $assign['feid']?>">edit </a>
                        <a href="./?q=DeleteExamination&id=<?php echo $assign['feid']?>&cid=<?php echo $_GET['course']; ?>"> delete</a>
                      </div>    
 </div>
 <hr/> 

                      <!-- text length -->
                      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script>
                            $(document).ready(function(){
                                var maxLength = 20;
                                $(".show-read-more").each(function(){
                                    var myStr = $(this).text();
                                    if($.trim(myStr).length > maxLength){
                                        var newStr = myStr.substring(0, maxLength);
                                        var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                                        $(this).empty().html(newStr);
                                        $(this).append(' <a href="javascript:void(0);" class="read-more">...</a>');
                                        $(this).append('<span class="more-text">' + removedStr + '</span>');
                                    }
                                });
                                $(".read-more").click(function(){
                                    $(this).siblings(".more-text").contents().unwrap();
                                    $(this).remove();
                                });
                            });
                            </script>
                            <style>
                            .show-read-more .more-text{
                                    display: none;
                                }
                            </style>


<?php $no++; }}else{?>
        <div style="display:flex; justify-content:center;"><h5 style="color:red;">There are no questions added for Examination review!</h5></div>
<?php }}?>
               

 

    </main>
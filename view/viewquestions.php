<?php require_once("header.php");?>
<main>



           
<?php 
$USER = mysqli_query($con, "SELECT departments.id as did, departments.department, faculty.user_id, faculty.d_id, users.id
FROM users
INNER JOIN faculty ON faculty.user_id = users.id
INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
while($row = mysqli_fetch_array($USER)){
  $assignments=mysqli_query($con, "SELECT assignments.id as aid, assignments.lesson_id, assignments.question, lessons.id, lessons.course_id, courses.id, courses.d_id, departments.id
  FROM assignments
  INNER JOIN lessons ON lessons.id=assignments.lesson_id
  INNER JOIN courses ON courses.id=lessons.course_id
  INNER JOIN departments ON departments.id=courses.d_id WHERE courses.d_id='".$row['did']."' AND assignments.lesson_id='".$_GET['id']."'");
  if(mysqli_num_rows($assignments) >= 1){
  while($assign=mysqli_fetch_array($assignments)){?>
<div style="display:flex; justify-content:space-between;background-color:white;padding:10px;">
                      <p class="show-read-more"><?php echo $assign['question'] ?></p>
                      <div style="display:flex; justify-content:space-around;">
                        <a href="./?q=UpdateAssignment&id=<?php echo $assign['aid']?>">edit </a>
                        <a href="./?q=DeleteAssignment&id=<?php echo $assign['aid']?>&lid=<?php echo $assign['lesson_id']; ?>"> delete</a>
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
<?php }}else{?>
        <div style="display:flex; justify-content:center;"><h5 style="color:red;">There are no questions added for assignment review!</h5></div>
<?php }}?>
<main>

<?php require_once("header.php");?>
<main>



<?php
 if (isset($_SESSION['email'])){
    if ($_SESSION['staff'] == '1'){
?>

<div class="cards">
            <div class="card-single">
              <div>
                <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $departments = mysqli_query($con, "SELECT count(*) FROM departments");
                  while($row = mysqli_fetch_array($departments)){
                    echo $row['count(*)'];
                  }
                  ?>
                </h1>
               <a href=""><span>Departments</span></a> 
              </div>
              <div>
              <span class="fa fa-list us"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
              <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $courses = mysqli_query($con, "SELECT COUNT(*)  as count 
                  FROM mycourses 
                  INNER JOIN courses on courses.id = mycourses.course_id 
                  WHERE mycourses.user_id = '".$_SESSION['user_id']."' AND courses.status = '0' AND mycourses.status = '2' ");
                  while($row = mysqli_fetch_array($courses)){
                    echo $row['count'];
                  }
                  ?>
              </h1>
               <a href=""><span>My Courses</span></a> 
              </div>
              <div>
              <span class="fa fa-book"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
              <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $lessons = mysqli_query($con, "SELECT Count(*) as count 
                  FROM lessons 
                  INNER JOIN courses on lessons.course_id = courses.id 
                  INNER JOIN mycourses on mycourses.course_id = courses.id 
                  INNER JOIN users on mycourses.user_id = users.id 
                  WHERE mycourses.user_id ='".$_SESSION['user_id']."' AND mycourses.status = '2' AND courses.status = '0'");
                  while($row = mysqli_fetch_array($lessons)){
                    echo $row['count'];
                  }
                  ?>
              </h1>
               <a href=""><span>My Lessons</span></a> 
              </div>
              <div>
              <span class="fa fa-sticky-note"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
              <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $lessons = mysqli_query($con, "SELECT Count(*) as count
                  FROM lessons
                  INNER JOIN assignments_done ON assignments_done.lesson_id = lessons.id
                  INNER JOIN users ON users.id = assignments_done.user_id WHERE assignments_done.user_id = '".$_SESSION['user_id']."' AND assignments_done.status = '2' ");
                  while($row = mysqli_fetch_array($lessons)){
                    echo $row['count'];
                  }
                  ?>
              </h1>
               <a href=""><span>Assignments Done</span></a> 
              </div>
              <div>
              <span class="fa fa-sticky-note"></span>
              </div>
            </div>

        </div>


        
        <div class="recent-grid">
          <div class="projects">
            <div class="card">
              <div class="card-header">
                <h2>my courses</h2>
                <a href="./?q=Mycourses"><button>See all <span class="fa fa-arrow-right"></span> </button></a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table width="100%">
                  <thead>
                    <tr>
                      <td>Department</td>
                      <td>courses</td>
                      <td>Status</td>
                    </tr>
                  </thead>

                  <?php 
                  $query = mysqli_query($con, "SELECT
                  courses.course, courses.id as cid, courses.status,
                  departments.id, departments.department,
                  mycourses.user_id, mycourses.course_id, mycourses.status,
                  users.id
                  FROM  courses 
                  INNER JOIN departments on departments.id = courses.d_id
                  INNER JOIN mycourses on courses.id = mycourses.course_id
                  INNER JOIN users on users.id = mycourses.user_id 
                  WHERE mycourses.user_id = '".$_SESSION['user_id']."' AND courses.status = '0'  ORDER BY mycourses.id desc LIMIT 3");
                  if(mysqli_num_rows($query) > 0){
                  while($row = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $row['department']?></td>
                      <td>
                              <?php if($row['status'] == 1){ ?>
                                    <a href="#" style="cursor: no-drop;"><?php echo $row['course']?></a>
                                <?php }elseif($row['status'] == 2){?>
                                    <a href="./?q=ViewLessons&courseid=<?php echo $row['cid']; ?>&coursename=<?php echo $row['course'];?>"><?php echo $row['course']?></a>
                              <?php } ?>
                     </td>
                      <td>

                        <!-- =========
                        1 = completed
                        2 = In Progress
                         ===========-->
                
                              <?php if($row['status'] == 1){ ?>
                                      <span class="status purple"></span>
                                      completed.
                                <?php }elseif($row['status'] == 2){?>
                                      <span class="status pink"></span>
                                      In Progress
                              <?php }?>

                      </td>
                  
                  
                    </tr>
                  </tbody>
                  <?php }}else{?>
                      <p style="color:red; margin: 20px;">You are not enrolled to any course. Go to courses to enrol.</p>
                   <?php } ?>
                </table>
                </div>
              </div>

            </div>

          </div>

          <div class="customers">
            <div class="card">
              <div class="card-header">
                  <h2>suggested for you</h2>
              </div>
              
          <?php
          $lessons = mysqli_query($con, "SELECT lessons.lesson_title, lessons.lesson_post, courses.id, courses.course, mycourses.course_id, mycourses.user_id, mycourses.status, users.id 
          FROM courses
          INNER JOIN mycourses on courses.id = mycourses.course_id
          INNER JOIN users on users.id = mycourses.user_id
          INNER JOIN lessons on lessons.course_id = courses.id
          WHERE mycourses.user_id = '".$_SESSION['user_id']."' and mycourses.status = 2
          ORDER BY RAND() LIMIT 2");
          if(mysqli_num_rows($lessons) > 0){
          while($row = mysqli_fetch_array($lessons)){
          ?>
              <div class="card-body">
                <div class="customer">
                  <div class="info">
                    <!-- <video style="color: black;" src="templates/posts/<?php echo $row['lesson_post'];?>" height="40px" width="40px" alt="customer"></video> -->
                   <div>
                      <a href=""><h4 class="show-read-more"><?php echo $row['lesson_title'];?></h4></a>
                    
                      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script>
                            $(document).ready(function(){
                                var maxLength = 35;
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
                      <small><?php echo $row['course']?></small>
                    </div>
                  </div>
                </div>
              </div> 
          <?php }}else{?>
            <h2 style="color: red; margin-left:10px;">No suggestions yet.</h2>
<?php }?>
            </div>
          </div>

</div> 






<?php }elseif($_SESSION['staff'] == '0'){?>





    <div class="cards">
            <div class="card-single">
              <div>
                <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $departments = mysqli_query($con, "SELECT count(*) FROM departments");
                  while($row = mysqli_fetch_array($departments)){
                    echo $row['count(*)'];
                  }
                  ?>
                </h1>
               <a href=""><span>Departments</span></a> 
              </div>
              <div>
              <span class="fa fa-list us"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
              <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                  FROM users
                  INNER JOIN faculty ON faculty.user_id = users.id
                  INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
                  while($row = mysqli_fetch_array($USER)){
                  $courses = mysqli_query($con, "SELECT COUNT(*) as count
                  FROM courses 
                  INNER JOIN departments on departments.id = courses.d_id 
                  WHERE departments.id = '".$row['did']."' and courses.status = '0'");
                  while($row1 = mysqli_fetch_array($courses)){
                    echo $row1['count'];
                  }
                }
                ?>
              </h1>
               <a href=""><span>Courses</span></a> 
              </div>
              <div>
              <span class="fa fa-book"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
              <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                  FROM users
                  INNER JOIN faculty ON faculty.user_id = users.id
                  INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
                  while($row = mysqli_fetch_array($USER)){
                  $lessons = mysqli_query($con, "SELECT Count(*) as count 
                  FROM lessons 
                  INNER JOIN courses on lessons.course_id = courses.id 
                  INNER JOIN departments on departments.id = courses.d_id 
                  WHERE departments.id = '".$row['did']."' AND courses.status = '0' ");
                  while($row1 = mysqli_fetch_array($lessons)){
                    echo $row1['count'];
                  }
                }
                  ?>
              </h1>
               <a href=""><span>Lessons</span></a> 
              </div>
              <div>
              <span class="fa fa-sticky-note"></span>
              </div>
            </div>

            <div class="card-single">
              <div>
                <h1 style="font-family: 'Poppins' ,sans-serif;">
                <?php 
                  $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                  FROM users
                  INNER JOIN faculty ON faculty.user_id = users.id
                  INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."'");
                  while($row = mysqli_fetch_array($USER)){
                  $users = mysqli_query($con, "SELECT count(*) as count 
                  FROM mycourses 
                  INNER JOIN users on users.id = mycourses.user_id 
                  INNER JOIN courses on courses.id = mycourses.course_id 
                  INNER JOIN departments on departments.id = courses.d_id WHERE departments.id = '".$row['did']."' GROUP by users.email");
                 echo $allenrolledusers = mysqli_num_rows($users);
                }
                  ?>
                </h1>
               <a href=""><span>users</span></a> 
              </div>
              <div>
              <span class="fa fa-users"></span>
              </div>
            </div> 
        </div>












        <div class="recent-grid">
          <div class="projects">
            <div class="card">
              <div class="card-header">
                <h2>my courses</h2>
                <a href="./?q=Courses"><button>See all <span class="fa fa-arrow-right"></span> </button></a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table width="100%">
                  <thead>
                    <tr>
                      <td>courses</td>
                      <td>Status</td>
                    </tr>
                  </thead>

                  <?php 
                   $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                   FROM users
                   INNER JOIN faculty ON faculty.user_id = users.id
                   INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
                   while($row = mysqli_fetch_array($USER)){
                        $courses = mysqli_query($con, "SELECT courses.id as cid, courses.course, departments.id, departments.department
                        FROM courses 
                        INNER JOIN departments on departments.id = courses.d_id 
                        WHERE departments.id = '".$row['did']."' AND courses.status = '0' LIMIT 3");
                         if(mysqli_num_rows($courses) > 0){
                        while($row1 = mysqli_fetch_array($courses)){
                  ?>
                  <tbody>
                    <tr>
                      <td><a href="#"><?php echo $row1['course']?></a></td>
                      <td> <a href="./?q=ViewLessons&courseid=<?php echo $row1['cid'];?>&coursename=<?php echo $row1['course'];?>">View Lessons</a></td>
                      
                    </tr>
                  
                  <?php } }else{?>
      <tr>
        <center><h4 style="color:red;">No approved courses.</h4></center>
      </tr>
      <?php }}?>
      </tbody>
                </table>
                </div>
              </div>

            </div>

          </div>

          <div class="customers">
            <div class="card">
              <div class="card-header">
                  <h2>Generate Report</h2>
              </div>
           <div class="card-body">
                <div class="customer">
                  <div class="info">
                 <div>
                      <!-- <a href=""><h4 class="show-read-more"><?php echo $row['lesson_title'];?></h4></a> -->
                    
                      
                      <small>
                        <?php
                        $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                        FROM users
                        INNER JOIN faculty ON faculty.user_id = users.id
                        INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
                        while($row = mysqli_fetch_array($USER)){?>
                        <a href="./?q=Report&department=<?php echo $row['did']?>">
                            <button style="width:120px; height: 40px; border:none;background-color:#1D2231; color:white;border-radius:20px;">View</button>
                        </a>
                        <?php }
                        ?>
                      </small>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>






<?php }}?>

</main>

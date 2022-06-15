<?php require_once("header.php");?>
<main>





 <?php 
            $courses = mysqli_query($con, "SELECT mycourses.course_id, mycourses.status as mystatus, mycourses.user_id, courses.id, courses.course, courses.status 
            FROM mycourses 
            INNER JOIN courses on courses.id = mycourses.course_id 
            WHERE mycourses.user_id = '".$_SESSION['user_id']."' AND courses.status = '0'");
            if(mysqli_num_rows($courses) > 0){
            while($row = mysqli_fetch_array($courses)){
      ?>



            <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                  <div class="overlay"></div>
                  <div class="content">
                    <h3><?php echo $row['course']?></h3>
                    <h6><?php 
                                $lessonsNO = mysqli_query($con, "SELECT count(*) FROM lessons WHERE course_id ='". $row['id']."'");
                                while($row3 = mysqli_fetch_array($lessonsNO)){
                                    echo $row3['count(*)'];
                                }
                                ?> Lessons</h6>
                    <p>
                        <!-- =========
                        1 = completed
                        2 = In Progress
                         ===========-->
                
                              <?php if($row['mystatus'] == 1){ ?>
                                      <span class="status purple"></span>
                                      completed.
                                <?php }else{?>
                                      <span class="status pink"></span>
                                      In Progress
                              <?php }?>
                    </p>
                  </div>
                  <div class="fav">
                      <?php
                      $courses1 = mysqli_query($con, " SELECT status, course_id, user_id from mycourses where course_id = '".$row['id']."' and user_id = '".$_SESSION['user_id']."'");
                      while($row1 = mysqli_fetch_array($courses1)){
                      ?>        
                              
                                <?php if($row1['status'] == 1){ ?>
                                      <a href="#"><button class="complete">Completed</button></a>
                                <?php }else{?> 
                                      <a href="./?q=ViewLessons&courseid=<?php echo $row['id']; ?>&coursename=<?php echo $row['course'];?>"><button class="continue">continue</button></a>
                               <?php }}?>
                              
                  </div>
                </div>
              </div>
            </div>
            </div>


        <?php }}else{?>
        <div style="display:flex; justify-content:center;"><h5 style="color:red;">Please Enrol to a Course to view your Courses!</h5></div>
        <?php }?>


<style>
.card {
	position: relative;
	height: 120px;
    background-color: white;
	border-radius: 25px;
	margin: 10px;
	transition: 0.25s ease-in;
}

.card .overlay {
	position: absolute;
	top: 0;
	bottom: 0;
	width: 100%;
	height: 170px;
	border-radius: 25px;
}

.card .content {
	position: absolute;
	bottom: 10px;
	left: 25px;
    color: black;
}

.card .content h4 {
	font-family: 'Poppins' ,sans-serif;
	font-weight: bold;
	font-size: 18px;
	color: black;
	margin-bottom: 10px;
	margin-top: 0;
}

.card .content h6 {
	font-family: Ubuntu;
	font-style: normal;
	font-weight: 500;
	font-size: 14px;
	color: black;
	margin-bottom: 10px;
	margin-top: 0;
}

.card .fav {
	position: absolute;
	top: 25px;
	right: 25px;
	cursor: pointer;
}

.card .fav button {
	color: white;
  background-color: #1D2231;
   border-radius: 10px;
  width: 100px;
  height: 40px;
  border: none;
}

.card .fav a .continue {
	color: white;
  background-color: #031d69;
   border-radius: 10px;
  width: 100px;
  height: 40px;
  border: none;
}

.card .fav a .complete {
	color: white;
  background-color: #111d41;
   border-radius: 10px;
  width: 100px;
  height: 40px;
  cursor: no-drop;
  border: none;
}

.card:hover {
	transform: scale(1.05);
}

.card:hover {
	background-position: top;
}
</style>

</main>
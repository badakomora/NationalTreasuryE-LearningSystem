<?php require_once("header.php");?>
<main>


<?php 
 $USER = mysqli_query($con, "SELECT departments.id as did, faculty.user_id, faculty.d_id, users.id
 FROM users
 INNER JOIN faculty ON faculty.user_id = users.id
 INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
 while($row = mysqli_fetch_array($USER)){
      $courses = mysqli_query($con, "SELECT courses.id as cid, courses.course, courses.status, departments.id
      FROM courses 
      INNER JOIN departments on departments.id = courses.d_id 
      WHERE departments.id = '".$row['did']."' ORDER BY cid Desc");
       if(mysqli_num_rows($courses) > 0){
      while($row1 = mysqli_fetch_array($courses)){
?>



      <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-12">
          <div class="card">
            <div class="overlay"></div>
            <div class="content">
              <h3><?php echo $row1['course']?></h3>
              
                   <?php if($row1['status'] == '0'){
                          $lessonsNO = mysqli_query($con, "SELECT count(*) FROM lessons WHERE course_id ='". $row1['cid']."'");
                          while($row2 = mysqli_fetch_array($lessonsNO)){?>
                             <h6><?php echo $row2['count(*)'];?> lessons</h6>
                   <?php  }
                      }elseif($row1['status'] == '2'){?>

                               <h6 style="color:red;">Course Declined</h6>

                  <?php }else{?>

                              <h6 style="color:red;">Pending...</h6> 

                  <?php  } ?> 
            </div>
              <div class="fav">
                <?php if($row1['status'] == '1'){?>
               
                 <h4 style="color:red;">Pending..</h4>
               
                 <?php }elseif($row1['status'] == '2'){?>
               
               <button class="delete" style="cursor: pointer;" id="myBtn<?php echo $row1['cid'];?>" onclick="enrol<?php echo $row1['cid']; ?>();">Delete Course</button>
               <script>
                           function enrol<?php echo $row1['cid']?>(){
                             var enrol = window.confirm("Are you sure you want to delete <?php echo $row1['course'];?>?");
                             if (enrol) {
                               document.location.href='./?q=DeleteCourses&courseid=<?php echo $row1['cid']?>';
                             }
                             else {
                               document.location.href='./?q=Courses';
                               }
                           }
               </script>
               

              <?php }else{?>
                <a href="./?q=ViewLessons&courseid=<?php echo $row1['cid'];?>&coursename=<?php echo $row1['course'];?>"><button class="add" style="cursor: pointer;">View Lessons</button></a>
               <?php }?>
              </div>
          </div>
        </div>
      </div>
      </div>


<?php } }else{?>
 <center>
 <h6 style="color:red;">No courses added to this faculty to view lessons.</h6>
 </center>
<?php }}?>





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

.card .fav .add {
	color: white;
  background-color: #1D2231;
   border-radius: 10px;
  width: 120px;
  height: 40px;
  border: none;
}

.card .fav a .edit {
	color: white;
  background-color: #031d69;
   border-radius: 10px;
  width: 100px;
  height: 40px;
  border: none;
}

.card .fav .delete {
	color: white;
  background-color: rgb(110, 13, 13);
   border-radius: 10px;
  border: none;
  width: 120px;
  height: 40px;
}

.card:hover {
	transform: scale(1.05);
}

.card:hover {
	background-position: top;
}
</style>
</main>
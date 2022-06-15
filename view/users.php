<?php require_once("header.php");?>
<main>



<?php 
       $USER = mysqli_query($con, "SELECT departments.id as did, faculty.user_id, faculty.d_id, users.id
       FROM users
       INNER JOIN faculty ON faculty.user_id = users.id
       INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '".$_SESSION['user_id']."' ");
       while($row = mysqli_fetch_array($USER)){
        $users = mysqli_query($con, "SELECT users.id as uid,users.email,users.staff, mycourses.user_id, mycourses.course_id, courses.id as cid, courses.course, courses.d_id, departments.id 
        FROM mycourses 
        INNER JOIN users on users.id = mycourses.user_id 
        INNER JOIN courses on courses.id = mycourses.course_id 
        INNER JOIN departments on departments.id = courses.d_id WHERE departments.id = '".$row['did']."' AND users.staff = '1' GROUP BY users.email");
        if(mysqli_num_rows($users) > 0){
        while($row1 = mysqli_fetch_array($users)){
      ?>



            <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                  <div class="overlay"></div>
                  <div class="content">
                    <h3><?php echo $row1['email']?></h3>
                    <h6>
                      

                    <?php 
                    $enrolld_user = $row1['uid'];
                    $enrolled_courses = mysqli_query($con, "SELECT mycourses.course_id, mycourses.user_id,mycourses.status, courses.id, courses.course, users.id, users.email
                    FROM mycourses
                    INNER JOIN courses on courses.id = mycourses.course_id
                    INNER JOIN users ON users.id = mycourses.user_id WHERE mycourses.user_id = '$enrolld_user' LIMIT 4");
                    while($row2 = mysqli_fetch_array($enrolled_courses)){
                      echo $row2['course'].", ";
                    }
                    // echo $row1['course'];
                    ?>
                  
                  
                  
                  </h6>
                  </div>
                  <div class="fav">
                     <a href="./?q=UpdateUser&id=<?php echo $row1['uid']?>"><button class="add">Edit User</button></a> 
                     <button class="delete" style="cursor: pointer;" id="myBtn<?php echo $row1['cid'];?>" onclick="enrol<?php echo $row1['uid']; ?>();">Delete User</button>
                      <script>
                                  function enrol<?php echo $row1['uid']?>(){
                                    var enrol = window.confirm("Are you sure you want to delete <?php echo $row1['email'];?>?");
                                    if (enrol) {
                                      document.location.href='./?q=DeleteUserDetails&id=<?php echo $row1['uid']?>&course=<?php echo $row1['cid'];?>';
                                    }
                                    else {
                                      document.location.href='./?q=Users';
                                      }
                                  }
                      </script>
                    </div>
                </div>
              </div>
            </div>
            </div>


      <?php } }else{?>
       <center>
       <h6 style="color:red;">No users enrolled to this faculty.</h6>
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
  width: 100px;
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
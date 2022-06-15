<?php require_once("admin/header.php");?>
<main>
<?php
if(isset($_POST['approve'])){
$msg="";
$status = $_POST['status'];
$course_id = $_POST['course_id'];
$query = mysqli_query($con, "UPDATE courses SET status = '$status' WHERE id = '$course_id'");
if($query){
  $msg = "Course Has Been Approved Successfully!";
  echo "<script type='text/javascript'>alert('$msg');</script>";
}else{
$msg = "An error Occurred. Please Try again!";
echo "<script type='text/javascript'>alert('$msg');</script>";
}
}
?>

<?php
if(isset($_POST['decline'])){
$msg="";
$status = $_POST['status'];
$course_id = $_POST['course_id'];
$query = mysqli_query($con, "UPDATE courses SET status = '$status' WHERE id = '$course_id'");
if($query){
  $msg = "Course Has Been Declined!";
  echo "<script type='text/javascript'>alert('$msg');</script>";
}else{
$msg = "An error Occurred. Please Try again!";
echo "<script type='text/javascript'>alert('$msg');</script>";
}
}
?>
      
      
      <?php 
            $courses = mysqli_query($con, "SELECT * FROM courses ORDER BY id desc");
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
                                while($row1 = mysqli_fetch_array($lessonsNO)){
                                    echo $row1['count(*)'];
                                }
                                ?> Lessons</h6>
                    
                      <?php
                      if($row['status'] == '1'){?>
                      <h6 style="color:orange;">pending Approval or Declination</h6>
                      <?php }elseif($row['status'] == '2'){?>
                      <h6 style="color:red;">Declined</h6>
                     <?php }else{?>
                        <h6 style="color:green;">Approved</h6>
                     <?php }?>
                  </div>
                    <div class="fav">
                     <?php 
                     if($row['status'] == '1'){?>

                        <div style="display:flex;">
                            <form action="" method="post" style="margin:2px;">
                              <input type="hidden" name="course_id" value="<?php echo $row['id'];?>">
                              <input type="hidden" name="status" value="<?php $status = 0; echo $status;?>">
                              <button class="approve" type="submit" name="approve" style="cursor: pointer;">Approve</button>
                            </form>

                            <form action="" method="post" style="margin:2px;">
                              <input type="hidden" name="course_id" value="<?php echo $row['id'];?>">
                              <input type="hidden" name="status" value="<?php $status = 2; echo $status;?>">
                              <button class="decline" type="submit" name="decline" style="cursor: pointer;">Decline</button>
                            </form>
                        </div>
                    
                      <?php }elseif($row['status'] == '2'){?>
                        <p style="color:red;">Declined.</p>
                     <?php }else{?>
                        <p style="color:green">In Progress...</p>
                    <?php }?>
                    </div>
                </div>
              </div>
            </div>
            </div>


            <?php } }else{?>
            <center>
            <h6 style="color:red;">No courses added to this system.</h6>
            </center>
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

.card .fav .add {
	color: white;
  background-color: #1D2231;
  border-radius: 10px;
  width: 100px;
  height: 40px;
  border: none;
}

.card .fav .decline {
	color: white;
  background-color: rgb(110, 13, 13);
  border-radius: 10px;
  width: 100px;
  height: 40px;
  border: none;
}
.card .fav .approve {
	color: white;
  background-color: rgb(26, 90, 20);
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
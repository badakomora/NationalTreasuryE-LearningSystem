<?php require_once("admin/header.php");?>
<main>

      <?php 
       $USER = mysqli_query($con, "SELECT *  FROM users");
       if(mysqli_num_rows($USER) > 0){
       while($row = mysqli_fetch_array($USER)){
      ?>



            <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                  <div class="overlay"></div>
                  <div class="content">
                    <h3><?php echo $row['email']?></h3>
                   <?php
                   $sql = mysqli_query($con, "SELECT departments.id, departments.department, faculty.user_id,faculty.user_id, users.id, users.staff
                   FROM departments 
                   INNER JOIN faculty on faculty.d_id = departments.id
                   INNER JOIN users on users.id = faculty.user_id
                   WHERE users.staff = '".$row['staff']."'  AND faculty.user_id = '".$row['id']."'");
                   while($row1 = mysqli_fetch_array($sql)){?>
                     
                    
                     <h6 style="color:green;">Role: Faculty Administrator - <?php echo $row1['department']?> Active. </h6>
                    

                  <?php }?>
                      
                      <?php if($row['staff'] == '1'){?>
                        <h6 style="color:green;">Role: Normal Staff. Active.</h6>
                        <?php }elseif($row['staff'] == '2'){?>

                        <h6 style="color:red;">Account Deactivated.</h6>
                        <p>Note: To activate user Account, assign back their initial Role.</p>

                        <?php } ?>
                  </div>
                  <div class="fav">
                      <a href="./?q=EditRole&id=<?php echo $row['id'];?>&staff=<?php echo $row['staff'];?>"><button class="edit" style="cursor: pointer;" id="myBtn<?php echo $row['id'];?>">Assign Role</button></a>
                      <button class="delete" style="cursor: pointer;" id="myBtn<?php echo $row['id'];?>" onclick="enrol<?php echo $row['id']; ?>();">Delete User</button>
                      <script>
                                  function enrol<?php echo $row['id']?>(){
                                    var enrol = window.confirm("Are you sure you want to delete <?php echo $row['email'];?>?");
                                    if (enrol) {
                                      document.location.href='./?q=DeleteUser&id=<?php echo $row['id']?>';
                                    }
                                    else {
                                      document.location.href='./?q=AdminUsers';
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
            <h6 style="color:red;">No Users added to this system.</h6>
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
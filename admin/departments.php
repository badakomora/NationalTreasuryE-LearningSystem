
<?php require_once("admin/header.php");?>
 <main>







      <div class="cards">
          <?php 
            $departments = mysqli_query($con, "SELECT * FROM departments");
            if(mysqli_num_rows($departments) > 0){
            while($row = mysqli_fetch_array($departments)){
          ?>
            <div class="card-single">
              <div>
                <h1 style="font-family: 'Poppins' ,sans-serif;">
                    <?php 
                    $courses = mysqli_query($con, "SELECT count(*) FROM courses where d_id = '".$row['id']."'");
                    while($row1 = mysqli_fetch_array($courses)){
                      echo $row1['count(*)'];
                    }
                    ?>
                </h1>
                <a href="#"><span><?php echo $row['department']?></span></a> 
                <br>
                <a href="./?q=CheckReport&department=<?php echo $row['id'];?>">Check Report <i class="fa fa-arrow-right"></i></a>
              </div>
              <div>
                <!-- <span class="fa fa-th-large"></span> -->
                <li class="dropdown">
                  <a href="#" class="dropbtn">
                    <i class="fa fa-ellipsis-v fa-2x" style="cursor: pointer; color:burlywood;"></i>
                    <div class="dropdown-content">
                        <a href="./?q=EditDepartment&id=<?php echo $row['id']?>" style="cursor:pointer;">Edit Department</a>
                        <hr>
                        <a onclick="enrol<?php echo $row['id']; ?>();" style="cursor:pointer;">Delete Department</a> 
                                <script>
                                  function enrol<?php echo $row['id']; ?>(){
                                    var enrol = window.confirm("Are you sure you want to delete <?php echo $row['department'];?>?");
                                    if (enrol) {
                                      document.location.href='./?q=DeleteDepartment&id=<?php echo $row['id']; ?>';
                                    }
                                    else {
                                      document.location.href='./?q=AdminDepartments';
                                      }
                                  }
                                </script>
                    </div>
                  </a>
                </li>
              </div>
            </div>
            <?php } }else{?>
            <center>
            <h6 style="color:red;">No departments added to this system.</h6>
            </center>
            <?php }?>
        </div>





      </main>

<?php require_once("header.php");?>
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
                    $courses = mysqli_query($con, "SELECT count(*) FROM courses where d_id = '".$row['id']."' AND courses.status = '0'");
                    while($row1 = mysqli_fetch_array($courses)){
                      echo $row1['count(*)'];
                    }
                    ?>
                </h1>
                <a href="./?q=ViewDepartments&department=<?php echo $row['id'];?>"><span><?php echo $row['department']?></span></a> 
              </div>
              <div>
                <!-- <span class="fa fa-th-large"></span> -->
              </div>
            </div>
            <?php }}else{?>
        <div style="display:flex; justify-content:center;"><h5 style="color:red;">No Departments Yet!</h5></div>
        <?php }?>
</div>

</main>
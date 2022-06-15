<?php require_once("admin/header.php");?>
<main>






        <div class="cards">
            <div class="card-single">
              <div>
                <h1 style="font-family: 'Poppins' ,sans-serif;">
                  <?php 
                  $departments = mysqli_query($con, "SELECT count(*) as count FROM departments");
                  while($row = mysqli_fetch_array($departments)){
                    echo $row['count'];
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
                  $courses = mysqli_query($con, "SELECT COUNT(*) as count FROM courses");
                  while($row = mysqli_fetch_array($courses)){
                    echo $row['count'];
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
                  $lessons = mysqli_query($con, "SELECT Count(*) as count FROM lessons");
                  while($row = mysqli_fetch_array($lessons)){
                    echo $row['count'];
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
                  $users = mysqli_query($con, "SELECT Count(*) as count FROM users");
                  while($row = mysqli_fetch_array($users)){
                    echo $row['count'];
                  }
                  ?></h1>
               <a href=""><span>Users</span></a> 
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
                <h2>Pending courses</h2>
                <a href="./?q=AdminCourses"><button>See all <span class="fa fa-arrow-right"></span> </button></a>
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
                  $query = mysqli_query($con, "SELECT * FROM  courses  WHERE status='1' ORDER BY RAND() LIMIT 3");
                  if(mysqli_num_rows($query) > 0){
                  while($row = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <tr>
                      <td> <a href="./?q=AdminCourses"><?php echo $row['course']?></a>
                     </td>
                      <td>
                         <span class="status purple"></span>
                                Pending...
                       </td>
                  
                    </tr>
                  </tbody>
                  <?php }}else{?>
                      <p style="color:red; margin: 20px;">No Pending courses</p>
                   <?php } ?>
                </table>
                </div>
              </div>

            </div>

          </div>

          <div class="customers">
            <div class="card">
              <div class="card-header">
                  <h2>Generate Reports</h2>
              </div>
         
              <div class="card-body">
                <div class="customer">
                  <div class="info">
                  
                   <div>
                     
                      <small><h3><a href="./?q=AdminDepartments">Reports <span class="fa fa-arrow-right"></span></a></h3></small>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>

        </div>  








</main>
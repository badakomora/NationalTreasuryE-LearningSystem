<?php require_once("admin/header.php"); ?>
<main>

  <div style="justify-content: space-between; display: flex;">

    <button onclick="printDiv();" class="brp-blue-header" style="width:120px; height: 40px; border:none;background-color:#1D2231; color:white;border-radius:10px;">Print <i class="fa fa-print"></i> </button>

  </div>

  <script>
    function printDiv() {
      var Content = document.getElementById("GFG").innerHTML;
      var a = window.open('', '');
      a.document.write(Content);
      a.document.close();
      a.print();
    }
  </script>
  <br><br>
  <div id="GFG" style="height:100vh;">

    <h1>DEPARTMENTS ANNUAL REPORT</h1>
    <br>

    <div style="display: flex;justify-content: space-between; ">
      <p><b>DEPARTMENT NAME:</b> &nbsp;&nbsp;<?php
                                              $USER = mysqli_query($con, "SELECT * FROM departments WHERE departments.id = '" . $_GET['department'] . "' ");
                                              while ($row = mysqli_fetch_array($USER)) {
                                                echo $row['department'];
                                              }
                                              ?></p>
      <p><b>DATE:</b> &nbsp;&nbsp;<?php echo date("Y/m/d"); ?></p>
    </div>


    <div style="justify-content: space-between; display: flex;">
      <P><b>NO. OF COURSES:</b> <?php
                                $courses = mysqli_query($con, "SELECT count(*) as count 
                  FROM courses WHERE courses.d_id = '" . $_GET['department'] . "'");
                                while ($row = mysqli_fetch_array($courses)) {
                                  echo $row['count'];
                                }
                                ?> </P>
      <P><b>NO. OF STAFFS:</b><?php
                              $users = mysqli_query($con, "SELECT count(*) as count 
                  FROM mycourses 
                  INNER JOIN users on users.id = mycourses.user_id 
                  INNER JOIN courses on courses.id = mycourses.course_id 
                  INNER JOIN departments on departments.id = courses.d_id WHERE departments.id = '" . $_GET['department'] . "'GROUP by users.email");
                              echo $allenrolledusers = mysqli_num_rows($users);
                              ?></P>
    </div>
    <P><b>NO. OF LESSONS:</b> <?php
                              $lessons = mysqli_query($con, "SELECT Count(*) as count 
                  FROM lessons 
                  INNER JOIN courses on lessons.course_id = courses.id 
                  INNER JOIN departments on departments.id = courses.d_id 
                  WHERE departments.id = '" . $_GET['department'] . "' AND courses.status = '0' ");
                              while ($row = mysqli_fetch_array($lessons)) {
                                echo $row['count'];
                              }
                              ?></P>


    <br>



    <table class="brp-project-details-table">
      <h3>COURSES DETAILS</h3>
      <tr style="border: 1px solid black; ">
        <td class="brp brp-beige-header">Course</td>
        <td class="brp brp-beige-header">Enrolled Staffs</td>
        <td class="brp brp-beige-header">Lessons_learnt</td>
        <td class="brp brp-beige-header">Attempted_Assignments</td>
        <td class="brp brp-beige-header">Status</td>
      </tr>
      <?php
      $courses = mysqli_query($con, "SELECT courses.id as cid, courses.status, courses.course, departments.id
            FROM courses 
            INNER JOIN departments on departments.id = courses.d_id 
            WHERE departments.id = '" . $_GET['department'] . "'");
      while ($row = mysqli_fetch_array($courses)) {
      ?>
        <tr>
          <td><?php echo $row['course'] ?></td>
          <td>
            <?php
            $users = mysqli_query($con, "SELECT COUNT(*) as count 
        FROM users
        INNER JOIN mycourses ON mycourses.user_id=users.id
        INNER JOIN courses ON courses.id=mycourses.course_id
        INNER JOIN departments ON departments.id=courses.d_id WHERE courses.id='" . $row['cid'] . "' AND courses.status='0' AND departments.id='" . $_GET['department'] . "'");
            while ($user = mysqli_fetch_array($users)) {
              echo $user['count'];
            }
            ?>
          </td>
          <td>
            <?php
            $lessons = mysqli_query($con, "SELECT COUNT(*) as count
        FROM lessons_learnt 
        INNER JOIN lessons ON lessons.id=lessons_learnt.lesson_id 
        INNER JOIN courses ON courses.id=lessons.course_id 
        INNER JOIN departments ON departments.id=courses.d_id WHERE courses.id='" . $row['cid'] . "' AND courses.status='0' AND departments.id='" . $_GET['department'] . "'");
            while ($lesson = mysqli_fetch_array($lessons)) {
              echo $lesson['count'];
            }
            ?>
          </td>
          <td>
            <?php
            $assignments = mysqli_query($con, "SELECT Count(*) as count
          FROM users 
          INNER JOIN assignments_done ON assignments_done.user_id = users.id 
          INNER JOIN lessons ON lessons.id = assignments_done.lesson_id
          INNER JOIN courses ON courses.id = lessons.course_id
          INNER JOIN departments ON departments.id=courses.d_id WHERE courses.id='" . $row['cid'] . "' AND courses.status='0' AND users.staff='1' AND departments.id='" . $_GET['department'] . "' AND assignments_done.status='2'");
            while ($assign = mysqli_fetch_array($assignments)) {
              echo $assign['count'];
            }
            ?>
          </td>
          <?php if ($row['status'] == '1') { ?>
            <td>pending</td>
          <?php } elseif ($row['status'] == '2') { ?>
            <td>Declined</td>
          <?php } else { ?>
            <td>Approved</td>
          <?php } ?></td>
        </tr>
      <?php } ?>
    </table>




    <br>

    <br>
    <table class="brp-project-kpi-table">
      <h3 class="brp-beige-header">PERFORMANCE</h3>
      <tr class="brp-beige-header" style="border: 1px solid black; ">
        <td>Course</td>
        <td>Performance</td>
      </tr>
      <?php
      $courses = mysqli_query($con, "SELECT courses.id as cid, courses.status, courses.course, departments.id
            FROM courses 
            INNER JOIN departments on departments.id = courses.d_id 
            WHERE departments.id = '" . $_GET['department'] . "'");
      while ($row = mysqli_fetch_array($courses)) {
      ?>
        <tr>
          <td width="50%"><?php echo $row['course']; ?></td>
          <td>
            <?php
            $lessons = mysqli_query($con, "SELECT final_results.course_id, sum(final_results.marks) as marks,  courses.id, departments.id, courses.d_id, courses.status
      FROM final_results
      INNER JOIN courses ON final_results.course_id=courses.id
      INNER JOIN departments ON departments.id=courses.d_id WHERE final_results.course_id='" . $row['cid'] . "' AND courses.status='0' AND departments.id='" . $_GET['department'] . "'");

            while ($lesson = mysqli_fetch_array($lessons)) {


              $lessons1 = mysqli_query($con, "SELECT *
      FROM final_results
      INNER JOIN courses ON final_results.course_id=courses.id
      INNER JOIN departments ON departments.id=courses.d_id WHERE final_results.course_id='" . $row['cid'] . "' AND courses.status='0' AND departments.id='" . $_GET['department'] . "'");

              $t = $lesson['marks'];
              if ($t == 0) {

                echo 'AVERAGE';
              } else {

                $count = mysqli_num_rows($lessons1);
                $total = $count * 100;

                $val = ($t / $total) * 100;



                if ($val >= 75) {
                  echo '<p><i>EXCELLENT</i></p>';
                } elseif (($val >= 50) and ($val <= 74)) {
                  echo '<p><i>GOOD</i></p>';
                } else {
                  echo '<p><i>AVERAGE</i></p>';
                }
              }
            }




            ?>



          </td>
        </tr>
      <?php } ?>
      <table>


        <br>

        <table class="brp-project-kpi-table">
          <h3 class="brp-beige-header">STAFFS AND DETAILS</h3>
          <tr class="brp-beige-header" style="border: 1px solid black; ">
            <th width="15" class="brp-beige-header">Staff Name</th>
            <th width="20%" class="brp-beige-header">Courses</th>
            <th width="10" class="brp-beige-header">Lessons_Learnt</th>
            <th width="15%" class="brp-beige-header">Attempted_Assignments</th>
            <th width="20%" class="brp-beige-header">Awarded Certificates</th>
          </tr>
          <?php
          $courses = mysqli_query($con, "SELECT courses.id as cid, courses.status, courses.course, departments.id
  FROM courses 
  INNER JOIN departments on departments.id = courses.d_id 
  WHERE departments.id = '" . $_GET['department'] . "'");
          while ($row = mysqli_fetch_array($courses)) {
            $users = mysqli_query($con, "SELECT users.id as uid, users.email,users.staff, mycourses.user_id,mycourses.course_id, courses.id,courses.course,courses.d_id,courses.status, departments.id
        FROM users
        INNER JOIN mycourses ON mycourses.user_id=users.id
        INNER JOIN courses ON courses.id=mycourses.course_id
        INNER JOIN departments ON departments.id=courses.d_id WHERE mycourses.course_id='" . $row['cid'] . "' AND courses.status='0' AND users.staff='1' AND departments.id='" . $_GET['department'] . "'");
            while ($user = mysqli_fetch_array($users)) {
          ?>
              <tr>
                <td align="left"> <?php echo $user['email']; ?></td>
                <td align="left"> <?php echo $user['course'] ?></td>
                <td align="center">
                  <?php
                  $lessons = mysqli_query($con, "SELECT COUNT(*) as count
        FROM lessons_learnt 
        INNER JOIN lessons ON lessons.id=lessons_learnt.lesson_id 
        INNER JOIN courses ON courses.id=lessons.course_id 
        INNER JOIN departments ON departments.id=courses.d_id WHERE courses.id='" . $row['cid'] . "' AND courses.status='0' AND departments.id='" . $_GET['department'] . "'");
                  while ($lesson = mysqli_fetch_array($lessons)) {
                    echo $lesson['count'];
                  }
                  ?>
                </td>
                <td align="center">
                  <?php
                  $assignments = mysqli_query($con, "SELECT Count(*) as count
          FROM users 
          INNER JOIN assignments_done ON assignments_done.user_id = users.id 
          INNER JOIN lessons ON lessons.id = assignments_done.lesson_id
          INNER JOIN courses ON courses.id = lessons.course_id
          INNER JOIN departments ON departments.id=courses.d_id WHERE courses.id='" . $row['cid'] . "' AND courses.status='0' AND users.staff='1' AND departments.id='" . $_GET['department'] . "' AND assignments_done.status='2'");
                  while ($assign = mysqli_fetch_array($assignments)) {
                    echo $assign['count'];
                  }
                  ?>
                </td>
                <td align="left" style="font-weight:bold">
                  <?php
                  $certs = mysqli_query($con, "SELECT Count(*) as count
          FROM users 
          INNER JOIN final_results ON final_results.user_id = users.id 
          INNER JOIN courses ON courses.id = final_results.course_id
          INNER JOIN departments ON departments.id=courses.d_id WHERE final_results.course_id='" . $row['cid'] . "' AND courses.status='0' AND users.staff='1' AND final_results.user_id = '" . $user['uid'] . "' AND departments.id='" . $_GET['department'] . "' AND final_results.status='1'");
                  while ($cert = mysqli_fetch_array($certs)) {
                    echo $cert['count'];
                  }
                  ?>
                </td>
              </tr>
          <?php }
          } ?>
        </table>

  </div>







  <style>
    body {
      padding: 0em;
      font-size: 16px;
    }

    .brp-label {
      font-weight: bold;
      text-align: right;
      padding-right: 10px;
    }

    .brp-main-header {
      background-color: #005D84;
      height: 3em;
      padding: 5px;
    }

    .brp-blue-header {
      font-size: 1.25em !important;
      font-weight: bold;
      color: black;
    }

    .brp-grey-header {
      font-size: 1.25em !important;
      font-weight: bold;
      background-color: white;
      color: black;
    }

    .brp-beige-header {
      font-size: 1em !important;
      font-weight: bold;
      color: black;
    }

    .brp-orange-header {
      font-size: 1.25em !important;
      font-weight: bold;
      background-color: #EFB210;
      color: black;
    }

    .brp-main-header-text {
      color: white;
      font-weight: bold;
      font-style: normal;
      font-size: 1.25em !important;
    }

    .brp-project-details-table {
      border: 1px solid black;
      width: 100%;
      float: left;
    }

    .brp-project-kpi-table {
      border: 1px solid black;
      width: 100%;
      float: right;
      margin-bottom: 25px;
    }

    .brp-project-full-width-table {
      border: 1px solid black;
      width: 100%;
      margin-top: 30px;
      clear: both;
    }

    .brp-project-full-width-table tr {
      border: 1px solid black;
    }

    .brp-project-full-width-table tr th {
      border: 1px solid black;
    }

    .brp-green-bg {
      background-color: #4CD137;
    }

    .brp-yellow-bg {
      background-color: #FFDD59;
    }

    .brp-red-bg {
      background-color: #FF3838;
    }

    .brp-orange-bg {
      background-color: #FF9900;
    }

    .brp-comments-header-row {
      border-bottom: 1px solid black;
      font-weight: bold;
    }

    /* .brp-table-data-row {

}
.brp-comments-data-row {

} */

    /* .brp-project-full-width-table tr:nth-child(odd) {background-color: white;} */
  </style>











</main>
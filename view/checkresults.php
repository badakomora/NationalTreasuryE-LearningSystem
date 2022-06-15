<?php require_once("header.php");?>
<main>


<h2>Select A Lesson to view performance</h2>
      
      <div class="top">
      <div class="container" style="margin:3px;">
          <form action="" method="POST" class="container">
              <div class="form-group">
                  <label>Check  Performance</label>
                  <div class="drop-container">
                      <span>Select a lesson</span>
                      <div class="drop-items">
                          <?php
                          $lessons = mysqli_query($con, "SELECT lessons.id as lii, lessons.course_id, courses.id as cid
                          FROM lessons
                          INNER JOIN courses on courses.id = lessons.course_id where lessons.course_id = '".$_GET['courseid']."'");
                          $no = 1;
                          while($row = mysqli_fetch_array($lessons)){
                          ?>
                          <span><a href="./?q=CheckResults&courseid=<?php echo $_GET['courseid'];?>&lesson=<?php echo $row['lii']; ?>">Lesson <?php echo $no;?></a> </span>
                          <?php $no++;}?>
                      </div>
                  </div>
              </div>
          </form>
      </div>
      </div>
      
      <?php
      if(isset($_POST['lesson'])){
          echo 'bada';
      }
      ?>
      
      
      
      <br>
      
      
      <div id="hide">
      <table class="my_table" >
      
      <tr>
        <th>Course</th>
        <th>Lesson</th>
        <th>Score</th>
        <th>Remarks</th>
      </tr>
      <?php
      $query =mysqli_query($con, "SELECT courses.id, courses.course, lessons.course_id, lessons.lesson_title, results.user_id, results.lesson_id, results.marks, users.id
      FROM users
      INNER JOIN results ON results.user_id = users.id
      INNER JOIN lessons ON lessons.id =results.lesson_id
      iNNER JOIN courses ON courses.id = lessons.course_id  WHERE results.user_id = '".$_SESSION['user_id']."' AND results.lesson_id='".$_GET['lesson']."' ");
      $num = mysqli_num_rows($query);
      if($num >= 1){
      while($row = mysqli_fetch_array($query)){
      ?>
      
      <tr>
        <td><?php echo $row['course']?></td>
        <td class="show-read-more"><?php echo $row['lesson_title']?></td>
        <td><?php echo $row['marks']?>%</td>
        <td>
          <?php
          if($row['marks'] >= '75'){
            echo 'EXCELLENT';
          }elseif($row['marks'] >= '50' AND $row['marks'] < '75'){
            echo 'GOOD';
          }else{
            echo 'AVERAGE';
          }
          ?>
        </td>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                  <script>
                                  $(document).ready(function(){
                                      var maxLength = 60;
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
      </tr>
      <?php }}else{?>
      <td>
      <?php
      $query1 =mysqli_query($con, "SELECT courses.id, courses.course, lessons.course_id, lessons.lesson_title, results.user_id, results.lesson_id, results.marks, users.id
      FROM users
      INNER JOIN results ON results.user_id = users.id
      INNER JOIN lessons ON lessons.id =results.lesson_id
      iNNER JOIN courses ON courses.id = lessons.course_id  WHERE results.user_id = '".$_SESSION['user_id']."' AND results.lesson_id='".$_GET['lesson']."' ");
      $num1 = mysqli_num_rows($query);
      if($num1 < 1){
      echo 'No data!';
      }}?>
      </td>
      </table>
      
      </div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
          <style>
      
      .top {
          display: flex;
          justify-content:space-between;
      }
      .container {
          display: flex;
          justify-content: center;
          align-items: center;
      }
      
      form .form-group {
          display: flex;
          align-items: center;
          border: solid rgb(16, 22, 48);
          border-width: 1px 0 1px 1px;
          width: 400px;
          box-sizing: border-box;
      }
      
      form .form-group label {
          flex-grow: 1;
          padding-left: 1rem;
      }
      
      .form-group .drop-container {
          position: relative;
          background-color: rgb(16, 22, 48);
          color: #fff; 
          min-width: 150px;
          user-select: none;
      }
      .form-group .drop-container span{
          padding: 10px 2rem;
          display: block;
          cursor: pointer;
      }
      
      .form-group .drop-items {
          position: absolute;
          background-color: rgb(16, 22, 48);
          color: #fff;
          width: 100%;
          left: 0;
          top: 100%;
          box-sizing: border-box;
          display: none;
      }
      
      .form-group .drop-items span {
          display: block;
          padding: 10px 2rem;
          cursor: pointer;
      }
      
      .form-group .drop-items span:not(.drop-items span:last-child) {
          border-bottom: 1px solid rgb(33, 42, 85);
      }
      
      .form-group .drop-items span:hover {
          background-color: rgb(22, 32, 73);
      }
      
      .form-group .display-items .drop-items {
          display: block;
      }
      table {
        border-collapse: 100%;
      }
       th {
        background: #ccc;
      }
      
      th, td {
        border: 1px solid #ccc;
        padding: 8px;
      }
      
      tr:nth-child(even) {
        background: #efefef;
      }
      
      tr:hover {
        background: #d1d1d1;
      }
          </style>
      
      
      
      
      
      <script>
          const DropContainer = document.querySelector('.drop-container')
          DropContainer.onclick = (e) => { 
          DropContainer.classList.toggle('display-items')
          DropContainer.querySelector('span').textContent = e.target.textContent
      }
      </script>

<main>
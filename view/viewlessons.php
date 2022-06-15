<?php require_once("header.php"); ?>
<main>



  <?php
  if (isset($_SESSION['email'])) {
    if ($_SESSION['staff'] == '1') {
      require_once('view/forms/enrol.php');
  ?>






      <article class="video-sec-wrap">
        <div class="video-sec">
          <h2><?php if (isset($_GET['coursename']) && $_GET['coursename'] != '') {
                $_GET['coursename'];
              }
              echo "Welcome to " . $_GET['coursename']; ?></h2>
          <h5 style="Color:red;">NOTE: Lessons are locked. To unlock, attempt the previous lesson first.</h5>
          <h1>Course Outline.</h1>

          <ul class="video-sec-middle" id="vid-grid">
            <?php
            $lessons = mysqli_query($con, "SELECT lessons.id as lii, lessons.lesson_title, lessons.lesson_post, lessons.course_id, courses.id as cid, courses.course
                        FROM lessons
                        INNER JOIN courses on courses.id = lessons.course_id where lessons.course_id = '" . $_GET['courseid'] . "'");
            $no = 1;
            while ($row = mysqli_fetch_array($lessons)) {
            ?>

              <li class="thumb-wrap" style="position: relative;">

                <?php
                $lesid = $row['lii'];
                $sql = "SELECT * FROM lessons_learnt WHERE user_id = '" . $_SESSION['user_id'] . "' AND lesson_id = '$lesid'";
                $result2 = mysqli_query($con, $sql);
                if (!$row2 = mysqli_fetch_assoc($result2)) {
                ?>


                  <div class="cover" style="height: 100%; position: absolute; width: 100%; cursor: no-drop;">
                    <div style="background-color:white; padding:30px;border-radius:20px;">
                      <h3 style="color: red;">Lesson <?php echo $no; ?> is Locked </h3>
                      <a href="#">
                        <p class="thumb-user show-read-more" style="padding-left:10px;cursor: no-drop;"><i class="fa fa-sticky-note"></i> <?php echo $row['lesson_title']; ?></p>
                      </a>
                    </div>
                  </div>


                <?php } ?>

                <div class="thumb-info">

                  <h3>Lesson <?php echo $no; ?> </h3>
                  <a style="display:flex; justify-content:space-between;" href="./?q=Lecture&lesson=<?php echo $row['lii'] ?>&user=<?php echo $_SESSION['user_id'] ?>">
                    <p class="thumb-user show-read-more" style="padding-left:10px;"><i class="fa fa-sticky-note"></i> <?php echo $row['lesson_title']; ?></p>
                    <button style="height:40px; width:120px;background-color:#111d42;color:white; border-radius:10px">View</button>
                    <p><a onclick="enrol<?php echo $row['lii']; ?>();"><i class="fa fa-calendar"></i> Assignment.</a></p>
                    <script>
                      function enrol<?php echo $row['lii']; ?>() {
                        alert("Attempt Lesson to unlock Assignment!");
                      }
                    </script>
                  </a>
                  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                  <script>
                    $(document).ready(function() {
                      var maxLength = 60;
                      $(".show-read-more").each(function() {
                        var myStr = $(this).text();
                        if ($.trim(myStr).length > maxLength) {
                          var newStr = myStr.substring(0, maxLength);
                          var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                          $(this).empty().html(newStr);
                          $(this).append(' <a href="javascript:void(0);" class="read-more">...</a>');
                          $(this).append('<span class="more-text">' + removedStr + '</span>');
                        }
                      });
                      $(".read-more").click(function() {
                        $(this).siblings(".more-text").contents().unwrap();
                        $(this).remove();
                      });
                    });
                  </script>
                  <style>
                    .show-read-more .more-text {
                      display: none;
                    }
                  </style>
                  <br>
                  <hr>

                </div>

              </li>
            <?php $no++;
            } ?>
          </ul>
          <?php
          $lasts = mysqli_query($con, "SELECT lessons.id as lii, lessons.lesson_title, lessons.lesson_post, lessons.course_id, courses.id as cid, courses.course
                        FROM lessons
                        INNER JOIN courses on courses.id = lessons.course_id where lessons.course_id = '" . $_GET['courseid'] . "' ORDER BY lii DESC LIMIT 1");
          $no = 1;
          while ($last = mysqli_fetch_array($lasts)) {
            $learntlessons = mysqli_query($con, "SELECT * FROM assignments_done WHERE user_id='" . $_SESSION['user_id'] . "' AND lesson_id='" . $last['lii'] . "' AND status='2'");
            $num = mysqli_num_rows($learntlessons);
            if ($num >= '1') {
          ?>
              <a href="#" onclick="enrol();" style="color:black">
                <h2>Final Examination <i class="fa fa-graduation-cap"></i></h2>
              </a>
              <script>
                function enrol() {
                  var enrol = window.confirm("This is your final test in this course. Your performance will determine the grade you will achieve on your certificate. The Exam Contains questions which requires you to think critically and clinically before you anwer. Be cautious with the timer so that you dont run out of time before you complete your exam. Success. If you do not wish to take this test now you can simply cancel and take it later.");
                  if (enrol) {
                    document.location.href = './?q=ExaminationPaper&course=<?php echo $last['cid']; ?>';
                  } else {
                    document.location.href = './?q=ViewLessons&courseid=<?php echo $last['cid']; ?>&coursename=<?php echo $last['course']; ?>';
                  }
                }
              </script>
          <?php } else {
              echo '';
            }
          } ?>
          <a class="video-showmore"></a>

        </div>
      </article>

      <style>
        .video-sec-wrap {
          width: 100%;
          min-height: 100vh;
        }

        .video-sec {
          width: 85%;
          margin: 3em auto;
          border-bottom: 2px solid #353535;
          text-align: left;
        }

        .video-sec-middle {
          grid-template-columns: repeat(5, 1fr);
          display: block;
          justify-content: center;
          align-content: center;
          grid-template-rows: auto;
          grid-row-gap: 15px;
          grid-column-gap: 10px;
          padding: 20px 0;
        }

        .thumb-wrap {
          display: flex;
          cursor: pointer;
        }

        .thumb {
          padding: 10px;
          background-color: white;
          display: block;
          margin: .4em;
          width: 100%;
          box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
          opacity: 1;
          transition: all .2s ease-in-out;
        }

        .thumb:hover {
          opacity: .8;
          box-shadow: 0 5px 10px 0 rgba(0, 0, 0, .5);
        }

        .thumb-info {
          display: block;
          height: 100%;
          width: 100%;
          padding: .4em;
        }

        .thumb-title {
          color: #f5f5f5;
          margin: 0;
          font-size: 1.2em;
        }

        .thumb-user {
          color: #7e7e7e;
          display: block;
          margin: 0;
          font-size: .9em;
        }

        .thumb-text {
          color: #7e7e7e;
          display: inline-block;
          margin: 0;
          font-size: .8em;
        }

        .video-sec-title {
          font-weight: bolder;
          font-size: 1.4em;
          color: #f5f5f5;
          margin: 5px 0 10px 10px;
        }

        .video-showmore {
          font-weight: bold;
          font-variant: all-petite-caps;
          display: block;
          color: #7e7e7e;
          padding: 10px;
          font-size: 1.2em;
        }

        @media only screen and (max-width: 1456px) {
          .video-sec-middle {
            grid-template-columns: repeat(4, 1fr);
          }
        }

        @media only screen and (max-width: 1024px) {
          .video-sec-middle {
            grid-template-columns: repeat(3, 1fr);
          }
        }

        @media only screen and (max-width: 756px) {
          .video-sec-middle {
            grid-template-columns: repeat(2, 1fr);
          }
        }

        @media only screen and (max-width: 496px) {
          .video-sec-middle {
            grid-template-columns: repeat(1, 1fr);
          }
        }
      </style>
      <script>
        var thumbTitle = $(".thumb-title");
        for (var i = 0; i <= thumbTitle.length; i++) {
          if (thumbTitle[i].innerHTML.length > 50) {
            var shortendTitle = thumbTitle[i].innerHTML.slice(0, 50);
            thumbTitle[i].innerHTML = shortendTitle.concat("...");
          }
        }
      </script>










    <?php } elseif ($_SESSION['staff'] == '0') { ?>











      <article class="video-sec-wrap">
        <div class="video-sec">
          <h3><?php
              if (isset($_GET['coursename']) && $_GET['coursename'] != '') {
                $_GET['coursename'];
              }
              echo "Welcome to " . $_GET['coursename']; ?></h3>
          <p><b>Lessons</b></p>
          <ul class="video-sec-middle" id="vid-grid">
            <?php
            $lessons = mysqli_query($con, "SELECT lessons.id as lii, lessons.lesson_title, lessons.lesson_post, lessons.course_id, courses.id as cid, courses.course
                        FROM lessons
                        INNER JOIN courses on courses.id = lessons.course_id where lessons.course_id = '" . $_GET['courseid'] . "'");
            $no = 1;
            if (mysqli_num_rows($lessons) >= 1) {
              while ($row = mysqli_fetch_array($lessons)) {
            ?>
                <li class="thumb-wrap" style="position: relative;">

                  <div class="thumb-info">
                    <p class="thumb-user show-read-more"><?php echo $row['lesson_title']; ?></p>
                    <a href="./?q=UpdateLesson&id=<?php echo $row['lii'] ?>"> Manage Lesson <i class="fa fa-gear"></i></p></a>
                    <!-- text length -->
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script>
                      $(document).ready(function() {
                        var maxLength = 25;
                        $(".show-read-more").each(function() {
                          var myStr = $(this).text();
                          if ($.trim(myStr).length > maxLength) {
                            var newStr = myStr.substring(0, maxLength);
                            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                            $(this).empty().html(newStr);
                            $(this).append(' <a href="javascript:void(0);" class="read-more">...</a>');
                            $(this).append('<span class="more-text">' + removedStr + '</span>');
                          }
                        });
                        $(".read-more").click(function() {
                          $(this).siblings(".more-text").contents().unwrap();
                          $(this).remove();
                        });
                      });
                    </script>
                    <style>
                      .show-read-more .more-text {
                        display: none;
                      }
                    </style>
                  </div>

                </li>
              <?php $no++;
              }
            } else { ?>
              <div style="display:flex; justify-content:center;">
                <h5 style="color:red;">There are no lessons added to this course!</h5>
              </div>
            <?php } ?>
          </ul>
          <a class="video-showmore">Show more</a>
        </div>
      </article>
      <style>
        .video-sec-wrap {
          width: 100%;
          min-height: 100vh;
        }

        .video-sec {
          width: 85%;
          margin: 3em auto;
          border-bottom: 2px solid #353535;
          text-align: left;
        }

        .video-sec-middle {
          grid-template-columns: repeat(5, 1fr);
          display: grid;
          justify-content: center;
          align-content: center;
          grid-template-rows: auto;
          grid-row-gap: 15px;
          grid-column-gap: 10px;
          padding: 20px 0;
        }

        .thumb-wrap {
          display: inline;
          cursor: pointer;
        }

        .thumb {
          padding: 10px;
          background-color: white;
          display: block;
          margin: .4em;
          width: 100%;
          box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
          opacity: 1;
          transition: all .2s ease-in-out;
        }

        .thumb:hover {
          opacity: .8;
          box-shadow: 0 5px 10px 0 rgba(0, 0, 0, .5);
        }

        .thumb-info {
          display: inline-block;
          height: 100%;
          width: 100%;
          padding: .4em;
        }

        .thumb-title {
          color: #f5f5f5;
          margin: 0;
          font-size: 1.2em;
        }

        .thumb-user {
          color: #7e7e7e;
          display: block;
          margin: 0;
          font-size: .9em;
        }

        .thumb-text {
          color: #7e7e7e;
          display: inline-block;
          margin: 0;
          font-size: .8em;
        }

        .video-sec-title {
          font-weight: bolder;
          font-size: 1.4em;
          color: #f5f5f5;
          margin: 5px 0 10px 10px;
        }

        .video-showmore {
          font-weight: bold;
          font-variant: all-petite-caps;
          display: block;
          color: #7e7e7e;
          padding: 10px;
          font-size: 1.2em;
        }

        @media only screen and (max-width: 1456px) {
          .video-sec-middle {
            grid-template-columns: repeat(4, 1fr);
          }
        }

        @media only screen and (max-width: 1024px) {
          .video-sec-middle {
            grid-template-columns: repeat(3, 1fr);
          }
        }

        @media only screen and (max-width: 756px) {
          .video-sec-middle {
            grid-template-columns: repeat(2, 1fr);
          }
        }

        @media only screen and (max-width: 496px) {
          .video-sec-middle {
            grid-template-columns: repeat(1, 1fr);
          }
        }
      </style>
      <script>
        var thumbTitle = $(".thumb-title");
        for (var i = 0; i <= thumbTitle.length; i++) {
          if (thumbTitle[i].innerHTML.length > 50) {
            var shortendTitle = thumbTitle[i].innerHTML.slice(0, 50);
            thumbTitle[i].innerHTML = shortendTitle.concat("...");
          }
        }
      </script>










  <?php }
  } ?>

</main>
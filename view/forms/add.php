<?php require_once("header.php"); ?>
<main>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'AddCourse') { ?>

        <!-- Add Courses -->

        <?php
        if (isset($_POST['addcourse'])) {
            $course = $_POST['course'];
            $did = $_POST['did'];
            // 1 = pending status
            $status = 1;
            $courses = mysqli_query($con, "SELECT * FROM courses where d_id = '$did' AND course='$course'");
            $courserows = mysqli_num_rows($courses);
            if ($courserows >= 1) {
                $msg = "Course Already Exists!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $query = mysqli_query($con, "INSERT INTO courses(course, d_id, status) VALUES('$course', '$did', '$status')");
                if ($query) {
                    $msg = "Course Added successfully! Please Wait for Admin Approval.";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                } else {
                    $msg = "An Error ocuured! Please try again!";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
            }
        }
        ?>









        <form action="" method="POST">

            <div><b>Add Course</b></div>

            <div>

                <label>Course Name.</label>

                <?php
                $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                                        FROM users
                                        INNER JOIN faculty ON faculty.user_id = users.id
                                        INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '" . $_SESSION['user_id'] . "' ");
                while ($row = mysqli_fetch_array($USER)) { ?>

                    <input type="hidden" name="did" value="<?php echo $row['did'] ?>" required>

                <?php  } ?>

                <input type="text" name="course" required placeholder="Do not quote or use apostrophe">

                <button class="add" type="submit" name="addcourse">Add</button>


            </div>

        </form>

        <br>
        <hr>







    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'AddLesson') { ?>







        <?php
        if (isset($_POST['addlesson'])) {
            $uploadOk = 1;
            $course_id = $_POST['course'];
            $coursetitle = $_POST['lessontitle'];
            $coursepost = $_FILES['lessonpost']['name'];
            $ext = pathinfo($coursepost, PATHINFO_EXTENSION);
            $lessons = mysqli_query($con, "SELECT * FROM lessons WHERE course_id = '$course_id' AND lesson_title='$coursetitle' AND lesson_post='$coursepost'");
            $lessonrows = mysqli_num_rows($lessons);
            if ($lessonrows >= 1) {
                $msg = "Lesson Already Exists!";
                $uploadOk = 0;
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {

                    $query = mysqli_query($con, "INSERT INTO lessons(lesson_title, lesson_post, course_id, file_ext) VALUES('$coursetitle', '$coursepost', '$course_id', '$ext')");
                    $target = "tools/files/" . basename($coursepost);
                    if (move_uploaded_file($_FILES['lessonpost']['tmp_name'], $target));
                    if ($query == true) {

                        $msg = "Lesson Added successfully!";
                        $uploadOk = 1;
                        echo "<script type='text/javascript'>alert('$msg');</script>";

                    } else {

                        $msg = "An Error ocuured! File is too large.";
                        $uploadOk = 0;
                        echo "<script type='text/javascript'>alert('$msg');</script>";

                    }

                
            }
        }
        ?>









        <form action="" method="POST" enctype="multipart/form-data">

            <div><b>Add Course Lesson</b></div>

            <div>

                <label>Lesson Description.</label>
                <input type="text" name="lessontitle" required placeholder="Do not quote or use apostrophe">
                <br>

                <label>Lesson Course.</label>
                <select name="course" style="height: 50px;width:100%;">
                    <option>Select Lesson Course.</option>
                    <?php
                    $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                                            FROM users
                                            INNER JOIN faculty ON faculty.user_id = users.id
                                            INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '" . $_SESSION['user_id'] . "' ");
                    while ($row = mysqli_fetch_array($USER)) {
                        $courses = mysqli_query($con, "SELECT courses.id as cid, courses.course, departments.id, departments.department
                                                    FROM courses 
                                                    INNER JOIN departments on departments.id = courses.d_id 
                                                    WHERE departments.id = '" . $row['did'] . "' AND courses.status = '0' LIMIT 3");
                        while ($row1 = mysqli_fetch_array($courses)) {
                    ?>
                            <option value="<?php echo $row1['cid'] ?>"><?php echo $row1['course'] ?></option>
                    <?php }
                    } ?>
                </select>
                <br><br>
                <label>Lesson Content.</label>
                <p><b>Note:</b> Accepted file extenions Mp4, pdf, ppt, pptx, docx. </p>
                <br>
                <input type="file" name="lessonpost" required>
                <br><br>
                <button class="add" name="addlesson" type="submit">Add</button>
            </div>
        </form>

        <br>
        <hr>












    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'AddAssignment') { ?>



        <?php
        if (isset($_POST['addassignment'])) {
            $lesson = $_POST['lesson'];
            $question = $_POST['question'];
            $option1 = $_POST['option1'];
            $option2 = $_POST['option2'];
            $option3 = $_POST['option3'];
            $option4 = $_POST['option4'];
            $answer = $_POST['answer'];

            $assignments = mysqli_query($con, "SELECT * FROM assignments WHERE lesson_id = '$lesson' AND question='$question' AND answer ='$answer'");
            $assignmentrows = mysqli_num_rows($assignments);
            if ($assignmentrows >= 1) {
                $msg = "Question Already Exists!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $query = mysqli_query($con, "INSERT INTO assignments(lesson_id, question, option1, option2, option3, option4, answer) 
        VALUES('$lesson', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')");
                if ($query) {
                    $msg = "Question Added successfully!";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                } else {
                    $msg = "An Error ocuured! Please try again!";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
            }
        }
        ?>


        <form action="" method="POST">

            <div><b>Add Question</b></div>
            <h6 style="color:red;">Note: You Can Add Upto 15 questions Only</h6>

            <div>
                <label>Select Lesson</label>
                <br>
                <select name="lesson" style="height:50px;width: 100%;">
                    <option selected>Select Lesson</option>
                    <?php
                    $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                                          FROM users
                                          INNER JOIN faculty ON faculty.user_id = users.id
                                          INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '" . $_SESSION['user_id'] . "' ");
                    while ($row = mysqli_fetch_array($USER)) {
                        $lessons = mysqli_query($con, "SELECT lessons.course_id, lessons.id as lid, lesson_title, courses.id as cid, departments.id, courses.d_id, courses.status
                                          FROM lessons 
                                          INNER JOIN courses on lessons.course_id = courses.id 
                                          INNER JOIN departments on departments.id = courses.d_id 
                                          WHERE departments.id = '" . $row['did'] . "' AND courses.status = '0'");
                        while ($row1 = mysqli_fetch_array($lessons)) {

                    ?>
                            <option value="<?php echo $row1['lid'] ?>"><?php echo $row1['lesson_title'] ?></option>
                    <?php }
                    } ?>
                </select>
                <label>Question.</label>
                <input type="text" name="question" required placeholder="Do not quote or use apostrophe">

                <label>Option 1.</label>
                <input type="text" name="option1" required placeholder="Do not quote or use apostrophe">

                <label>Option 2.</label>
                <input type="text" name="option2" required placeholder="Do not quote or use apostrophe">

                <label>Option 3.</label>
                <input type="text" name="option3" required placeholder="Do not quote or use apostrophe">

                <label>Option 4.</label>
                <input type="text" name="option4" required placeholder="Do not quote or use apostrophe">

                <label>Select Correct Answer</label>
                <br>
                <select name="answer" style="height:50px;width: 100%;">
                    <option selected>Select Correct Answer</option>
                    <option value="1">Option One</option>
                    <option value="2">Option Two</option>
                    <option value="3">Option Three</option>
                    <option value="4">Option Four</option>
                </select>
                <br><br>
                <button class="add" type="submit" name="addassignment">Add</button>

            </div>
        </form>

        <br>
        <hr>






    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'AddExamination') { ?>

        <?php
        if (isset($_POST['addexamination'])) {
            $course = $_POST['course'];
            $question = $_POST['question'];
            $option1 = $_POST['option1'];
            $option2 = $_POST['option2'];
            $option3 = $_POST['option3'];
            $option4 = $_POST['option4'];
            $answer = $_POST['answer'];


            $examinations = mysqli_query($con, "SELECT * FROM final_exam WHERE course_id = '$course' AND question='$question' AND answer='$answer'");
            $examinationrows = mysqli_num_rows($examinations);
            if ($examinationrows >= 1) {
                $msg = "Question Already Exists!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $query = mysqli_query($con, "INSERT INTO final_exam(course_id, question, option1, option2, option3, option4, answer) 
        VALUES('$course', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')");
                if ($query) {
                    $msg = "Question Added successfully!";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                } else {
                    $msg = "An Error ocuured! Please try again!";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
            }
        }
        ?>




        <form action="" method="POST">

            <div><b>Add Question</b></div>
            <h6 style="color:red;">Note: You Can Add Upto 10 questions Only</h6>

            <div>
                <select name="course" style="height: 50px;width:100%;">
                    <option>Select Course.</option>
                    <?php
                    $USER = mysqli_query($con, "SELECT departments.id as did,faculty.user_id, faculty.d_id, users.id
                                            FROM users
                                            INNER JOIN faculty ON faculty.user_id = users.id
                                            INNER JOIN departments ON faculty.d_id = departments.id WHERE faculty.user_id = '" . $_SESSION['user_id'] . "' ");
                    while ($row = mysqli_fetch_array($USER)) {
                        $courses = mysqli_query($con, "SELECT courses.id as cid, courses.course, departments.id, departments.department
                                                    FROM courses 
                                                    INNER JOIN departments on departments.id = courses.d_id 
                                                    WHERE departments.id = '" . $row['did'] . "' AND courses.status = '0' LIMIT 3");
                        while ($row1 = mysqli_fetch_array($courses)) {
                    ?>
                            <option value="<?php echo $row1['cid'] ?>"><?php echo $row1['course'] ?></option>
                    <?php }
                    } ?>
                </select>
                <label>Question.</label>
                <input type="text" name="question" required placeholder="Do not quote or use apostrophe">

                <label>Option 1.</label>
                <input type="text" name="option1" required placeholder="Do not quote or use apostrophe">

                <label>Option 2.</label>
                <input type="text" name="option2" required placeholder="Do not quote or use apostrophe">

                <label>Option 3.</label>
                <input type="text" name="option3" required placeholder="Do not quote or use apostrophe">

                <label>Option 4.</label>
                <input type="text" name="option4" required placeholder="Do not quote or use apostrophe">

                <label>Select Correct Answer</label>
                <br>
                <select name="answer" style="height:50px;width: 100%;">
                    <option selected>Select Correct Answer</option>
                    <option value="1">Option One</option>
                    <option value="2">Option Two</option>
                    <option value="3">Option Three</option>
                    <option value="4">Option Four</option>
                </select>
                <br><br>
                <button class="add" type="submit" name="addexamination">Add</button>

            </div>
        </form>

        <br>
        <hr>












    <?php } else {
        $msg = "An Error ocuured! Please try again!";
        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Dashboard';
            </script>";
    } ?>
</main>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box
    }

    .container {
        /* background: #1977cc; */
        color: black;
        border-radius: 10px;
        padding: 20px;
        font-family: 'Montserrat', sans-serif;
        max-width: 700px
    }

    .container>p {
        font-size: 32px
    }

    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }

    .add {
        color: white;
        background-color: #031d69;
        width: 100px;
        height: 40px;
        border: none;
    }

    a .exit {
        color: white;
        background-color: rgb(110, 13, 13);
        border: none;
        width: 120px;
        height: 40px;
    }
</style>
</main>
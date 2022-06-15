<?php require_once("header.php"); ?>
<main>

    <?php if (isset($_GET['q']) and $_GET['q'] == 'UpdateCourse') { ?>


        <?php
        if (isset($_POST['updatecourse'])) {
            $course = $_POST['course'];
            $id = $_POST['id'];
            $query = mysqli_query($con, "UPDATE courses SET course = '$course' WHERE id = '$id'");
            if ($query) {
                $msg = "Course updated Successfully!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $msg = "An Error ocuured! Please try again!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        }
        ?>






        <form action="" method="POST">

            <div><b>Update Course</b></div>

            <div>

                <label>Course Name.</label>

                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" required>
                <?php
                $query = mysqli_query($con, "SELECT * FROM courses WHERE id = '" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($query)) { ?>


                    <input type="text" name="course" value="<?php echo $row['course'] ?>" required>


                <?php
                }
                ?>
                <button class="add" type="submit" name="updatecourse">Update</button>

            </div>
        </form>

        <br>
        <hr>














    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'UpdateLesson') { ?>


        <?php
        if (isset($_POST['updatelesson'])) {
            $id = $_POST['lid'];
            $lessontitle = $_POST['lessontitle'];
            $lessonpost = $_FILES['lessonpost']['name'];
            $ext = pathinfo($lessonpost, PATHINFO_EXTENSION);
            $query = mysqli_query($con, "UPDATE lessons SET lesson_title = '$lessontitle' , lesson_post = '$lessonpost', file_ext = '$ext'  WHERE id = '$id' ");
            $target = "tools/files/" . basename($lessonpost);
            if (move_uploaded_file($_FILES['lessonpost']['tmp_name'], $target));
            if ($query) {
                $msg = "Lesson updated Successfully!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $msg = "An Error ocuured! Please try again!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        }
        ?>







        <form action="" method="POST" enctype="multipart/form-data">

            <div><b>Update Course Lesson</b></div>

            <div>
                <?php
                $query = mysqli_query($con, "SELECT * FROM lessons WHERE id = '" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($query)) {
                ?>

                    <label>Lesson Description.</label>
                    <input type="text" maxlength="100" name="lessontitle" value="<?php echo $row['lesson_title']; ?>" placeholder="Do not quote or use apostrophe" required>
                    <br>
                    <label>Update Lesson Content.</label>
                    <p><b>Note:</b> Accepted file extenions Mp4, pdf, ppt, pptx, docx. </p>
                    <br>
                    <input type="file" name="lessonpost" required>
                    <br>
                    <input type="hidden" name="lid" value="<?php echo $row['id'] ?>">
                    <br>
                    <button class="add" name="updatelesson" type="submit">Update</button>
                    <button class="exit" style="cursor: pointer;" onclick="enrol();">Delete Lesson</button>
                    <script>
                        function enrol() {
                            var enrol = window.confirm("Are you sure you want to delete this lesson?");
                            if (enrol) {
                                document.location.href = './?q=DeleteLesson&id=<?php echo $row['id'] ?>';
                            } else {
                                document.location.href = './?q=Lessons';
                            }
                        }
                    </script>
                <?php } ?>
            </div>
        </form>

        <br>
        <hr>






    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'UpdateAssignment') { ?>





        <?php
        if (isset($_POST['updateassignment'])) {
            $id = $_POST['id'];
            $lid = $_POST['lid'];
            $question = $_POST['question'];
            $option1 = $_POST['option1'];
            $option2 = $_POST['option2'];
            $option3 = $_POST['option3'];
            $option4 = $_POST['option4'];
            $answer = $_POST['answer'];
            $query = mysqli_query($con, "UPDATE assignments SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' WHERE id='$id' ");
            if ($query) {
                $msg = "Question updated Successfully!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $msg = "An Error ocuured! Please try again!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        }
        ?>




        <form action="" method="POST">

            <div><b>Update Question</b></div>
            <p><b style="color:red;">Note</b>: Do forget to update the correct answer!</p>

            <div>
                <br>
                <?php
                $assignments = mysqli_query($con, "SELECT * FROM assignments WHERE id = '" . $_GET['id'] . "'");
                while ($row1 = mysqli_fetch_array($assignments)) {
                ?>
                    <label>Question.</label>
                    <input type="text" name="question" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['question']; ?>">

                    <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
                    <input type="hidden" name="lid" value="<?php echo $row1['lesson_id']; ?>">

                    <label>Option 1.</label>
                    <input type="text" name="option1" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option1']; ?>">

                    <label>Option 2.</label>
                    <input type="text" name="option2" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option2']; ?>">

                    <label>Option 3.</label>
                    <input type="text" name="option3" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option3']; ?>">

                    <label>Option 4.</label>
                    <input type="text" name="option4" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option4']; ?>">

                    <label>Select Correct Answer</label>
                    <br>
                    <select name="answer" style="height:50px;width: 100%;" required>
                        <option selected>Select Correct Answer</option>
                        <option value="1">Option One</option>
                        <option value="2">Option Two</option>
                        <option value="3">Option Three</option>
                        <option value="4">Option Four</option>
                    </select>
                    <br><br>
                    <button class="add" type="submit" name="updateassignment">Update</button>

            </div>
        <?php } ?>
        </form>

        <br>
        <hr>






    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'UpdateExamination') { ?>


        <?php
        if (isset($_POST['updateexamination'])) {
            $id = $_POST['id'];
            $cid = $_POST['cid'];
            $question = $_POST['question'];
            $option1 = $_POST['option1'];
            $option2 = $_POST['option2'];
            $option3 = $_POST['option3'];
            $option4 = $_POST['option4'];
            $answer = $_POST['answer'];
            $query = mysqli_query($con, "UPDATE final_exam SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' WHERE id='$id' ");
            if ($query) {
                $msg = "Question updated Successfully!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } else {
                $msg = "An Error ocuured! Please try again!";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
        }
        ?>













        <form action="" method="POST">

            <div><b>Update question</b></div>
            <p><b style="color:red;">Note</b>: Do forget to update the correct answer!</p>

            <div>
                <br>
                <?php
                $assignments = mysqli_query($con, "SELECT * FROM final_exam WHERE id = '" . $_GET['id'] . "'");
                while ($row1 = mysqli_fetch_array($assignments)) {
                ?>
                    <label>Question.</label>
                    <input type="text" name="question" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['question']; ?>">

                    <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
                    <input type="hidden" name="cid" value="<?php echo $row1['course_id']; ?>">

                    <label>Option 1.</label>
                    <input type="text" name="option1" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option1']; ?>">

                    <label>Option 2.</label>
                    <input type="text" name="option2" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option2']; ?>">

                    <label>Option 3.</label>
                    <input type="text" name="option3" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option3']; ?>">

                    <label>Option 4.</label>
                    <input type="text" name="option4" required placeholder="Do not quote or use apostrophe" value="<?php echo $row1['option4']; ?>">

                    <label>Select Correct Answer</label>
                    <br>
                    <select name="answer" style="height:50px;width: 100%;" required>
                        <option value="">Select Correct Answer</option>
                        <option value="1">Option One</option>
                        <option value="2">Option Two</option>
                        <option value="3">Option Three</option>
                        <option value="4">Option Four</option>
                    </select>
                    <br><br>
                    <button class="add" type="submit" name="updateexamination">Update</button>

            </div>
        <?php } ?>
        </form>

        <br>
        <hr>







    <?php  } elseif (isset($_GET['q']) and $_GET['q'] == 'UpdateUser') { ?>

        <?php
        if (isset($_SESSION['email'])) {
            if ($_SESSION['staff'] == '0') {
        ?>




                <?php
                if (isset($_POST['updateuser'])) {

                    $id = $_GET['id'];
                    $password = $_POST['password'];
                    $query = mysqli_query($con, "UPDATE users SET password='$password' WHERE id='$id' ");
                    if ($query) {
                        $msg = "Password updated Successfully!";
                        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Users';
            </script>";
                    } else {
                        $msg = "An Error ocuured! Please try again!";
                        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Users';
            </script>";
                    }
                }
                ?>



                <form action="" method="POST">

                    <div><b>Update User Password</b></div>


                    <label>Password.</label>
                    <input type="text" name="password" required placeholder="Do not quote or use apostrophe">
                    <button class="add" type="submit" name="updateuser">Update</button>
                </form>

                <br>
                <hr>



            <?php } elseif ($_SESSION['staff'] == '1') { ?>





                <?php
                if (isset($_POST['updateuser'])) {

                    $id = $_GET['id'];
                    $password = $_POST['password'];
                    $query = mysqli_query($con, "UPDATE users SET password='$password' WHERE id='$id' ");
                    if ($query) {
                        $msg = "Password updated Successfully! You can now Sign In.";
                        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = 'includes/logout.php';
            </script>";
                    } else {
                        $msg = "An Error ocuured! Please try again Later!";
                        echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=Dashboard';
            </script>";
                    }
                }
                ?>



                <form action="" method="POST">

                    <div><b>Update User Password</b></div>


                    <label>Password.</label>
                    <input type="text" name="password" id="myInput" required placeholder="Do not quote or use apostrophe">
                    <button class="add" type="submit" name="updateuser">Update</button>
                    <input type="checkbox" onclick="myFunction()"><b>Show Password</b>
                    <script>
                        function myFunction() {
                            var x = document.getElementById("myInput");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                </form>

                <br>
                <hr>







    <?php }
        }
    } else {
        $msg = "An Error ocuured! Please try again!";
        echo "<script type='text/javascript'>alert('$msg');</script>";
    } ?>
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

        .exit {
            color: white;
            background-color: rgb(110, 13, 13);
            border: none;
            width: 120px;
            height: 40px;
        }
    </style>
</main>
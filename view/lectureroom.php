<?php require_once("header.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<main>


    <?php
    $stdid = $_SESSION['user_id'];
    $lesid = $_GET['lesson'];

    $sql = "SELECT courses.id FROM courses INNER JOIN lessons ON lessons.course_id = courses.id WHERE lessons.id = '$lesid' ";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $courseid = $row['id'];

        $sql = "SELECT id FROM lessons WHERE course_id = '$courseid' AND id > '$lesid' LIMIT 1";
        $result = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $lesid2 = $row['id'];

            $s = mysqli_query($con, "SELECT * FROM lessons_learnt where user_id = '$stdid'  AND lesson_id ='$lesid2'");
            $num = mysqli_num_rows($s);
            if ($num >= 1) {
                echo '';
            } else {
                $sql = "INSERT INTO lessons_learnt(user_id, lesson_id) VALUES ('$stdid', '$lesid2')";
                $query = mysqli_query($con, $sql);
            }
        }
    }
    $status = 0;
    $select = mysqli_query($con, "SELECT * FROM assignments_done WHERE lesson_id = '$lesid' AND user_id = '$stdid'");
    $num = mysqli_num_rows($select);
    if ($num >= 1) {
        echo '';
    } else {
        $assignments = mysqli_query($con, "INSERT INTO assignments_done(lesson_id, user_id, status) VALUES('$lesid', '$stdid', '$status')");
    }
    ?>









    <div id="playlist">

        <div id="video-dis">
            <?php
            $lessons = mysqli_query($con, "SELECT lessons.id as lii, lessons.lesson_title, lessons.lesson_post, lessons.course_id, lessons.file_ext, courses.id as cid, courses.course
    FROM lessons
    INNER JOIN courses on courses.id = lessons.course_id where lessons.id = '" . $_GET['lesson'] . "'");
            while ($row = mysqli_fetch_array($lessons)) {

                if ($row['file_ext'] == 'mp4') {
            ?>



                    <section id="skin">
                        <video id="myMovie<?php echo $_SESSION['user_id']; ?>" width="640" height="360">
                            <source src="tools/files/<?php echo $row['lesson_post']; ?>" />
                        </video>
                        <nav>
                            <div id="buttons">
                                <button type="button" id="playButton">Play</button>
                            </div>
                            <div id="defaultBar">
                                <div id="progressBar"></div>
                            </div>
                            <div style="clear:both"></div>
                        </nav>
                        <p id="vidtimer"></p>
                    </section>
                    <?php include 'includes/video.php'; ?>

                <?php } elseif ($row['file_ext'] == 'pdf' or $row['file_ext'] == 'ppt' or $row['file_ext'] == 'pptx' or $row['file_ext'] == 'docx') { ?>

                    <iframe id="display-frame" src="http://docs.google.com/gview?url=https://poamdailynews.000webhostapp.com/tools/files/<?php echo $row['lesson_post']; ?>&embedded=true" frameborder="0" scrolling="no"></iframe>

                <?php } else { ?>
                    <P style="color:red">An Error Occurred!</P>
                <?php } ?>
                <div class="card-body">
                    <div class="card-title " id="Title"><?php echo $row['lesson_title']; ?></div>
                </div>
        </div>

    <?php } ?>

    <div id="v-list" class="video-li">

        <div id="vli-info">
            <div id="upper-info">
                <div id="li-titles">
                    <div class="title">Lesson Requirement.</div>
                    <ul>
                        <li>Mark Attempt to unlock assignment at the end of the lesson.</li>
                    </ul>
                </div>
            </div>
            <div id="lower-info">
                <table style="width:100%">
                    <tr>
                        <th>Attempt</th>
                        <th>Date of Attempt</th>
                    </tr>
                    <tr>
                        <td>
                            <form id="form" action="./?q=Attempt" method="post">
                                <?php
                                $lessons = mysqli_query($con, "SELECT lessons.id, assignments_done.lesson_id, users.id, assignments_done.user_id, assignments_done.status
                FROM lessons
                INNER JOIN assignments_done ON assignments_done.lesson_id = lessons.id
                INNER JOIN users ON users.id = assignments_done.user_id WHERE assignments_done.lesson_id = '" . $_GET['lesson'] . "' AND assignments_done.user_id = '" . $_SESSION['user_id'] . "'");
                                while ($row = mysqli_fetch_array($lessons)) {  ?>
                                    <?php if ($row['status'] == '0') { ?>
                                        <input type="checkbox" class="checkbox" name="status" value="1">
                                        <input type="hidden" name="lesson" value="<?php echo $_GET['lesson'] ?>">
                                    <?php } elseif ($row['status'] == '1') { ?>
                                        <input type="checkbox" class="checkbox" name="status" value="1">
                                        <input type="hidden" name="lesson" value="<?php echo $_GET['lesson'] ?>">
                                <?php } elseif ($row['status'] == '2') {
                                        echo 'Attempted';
                                    }
                                } ?>
                            </form>
                            <script>
                                $(".checkbox").change(function() {
                                    if ($(this).prop('checked') == true) {
                                        $("#form").submit();
                                    }
                                });
                            </script>
                        </td>
                        <td><?php echo date("Y/m/d"); ?></td>
                    </tr>
                </table>
                <style>
                    table,
                    th,
                    td {
                        border: 1px solid grey;
                    }
                </style>
            </div>
        </div>
        <br>
        <div id="vli-videos">
            <div class="video-con active-con" style="position: relative;">

                <div class="v-titles">
                    <?php
                    $lessons = mysqli_query($con, "SELECT lessons.id, assignments_done.lesson_id, users.id, assignments_done.user_id, assignments_done.status
                FROM lessons
                INNER JOIN assignments_done ON assignments_done.lesson_id = lessons.id
                INNER JOIN users ON users.id = assignments_done.user_id WHERE assignments_done.lesson_id = '" . $_GET['lesson'] . "' AND assignments_done.user_id = '" . $_SESSION['user_id'] . "'");
                    while ($row = mysqli_fetch_array($lessons)) {  ?>
                        <?php if ($row['status'] == '0') { ?>
                            <p style="Padding:10px;"><a href="" onclick="attempt();"><i class="fa fa-calendar"></i> Assignment.</a></p>
                            <script>
                                function attempt() {
                                    alert("Something went wrong! Please Finish up the lesson and mark attempt to unlock assignment.");
                                }
                            </script>
                        <?php } elseif ($row['status'] == '2') { ?>

                            <p style="Padding:10px;"><a href="" onclick="attempt();"><i class="fa fa-calendar"></i> Assignment not Available.</a></p>
                            <script>
                                function attempt() {
                                    alert("Please contact your Faculty Administrator for more information.");
                                }
                            </script>


                        <?php } else { ?>

                            <p style="Padding:10px;"><a href="./?q=AssignmentPaper&lesson=<?php echo $_GET['lesson']; ?>"><i class="fa fa-calendar"></i> Assignment.</a></p>

                    <?php }
                    } ?>
                </div>
            </div>
        </div>

    </div>
    </div>











    <style>
        :root {
            --primary: #fbfcfc;
            --active: #f1f1f1;
            --secondary: #767777;
            --grey: #8a8b8b;
            --b-pad: 10px;
            --s-pad: 5px;
            --bg: rgb(50, 50, 50);
        }

        a.channel {
            color: inherit;
            text-decoration: none;
        }

        a.channel:hover {
            text-decoration: underline;
        }

        .title {
            color: var(--secondary);
            font-size: 15px;
            font-weight: bold;
        }

        .sub-title {
            color: var(--grey);
            font-size: 13px;
        }

        .icon-active {
            filter: sepia(100%) hue-rotate(150deg) saturate(400%);
        }

        #playlist {
            top: 50%;
            left: 50%;
            width: 100%;
            height: 60vh;
            display: flex;
        }

        #video-dis {
            flex: 6.5;
            margin-right: 20px;
            background: black;
        }

        #video-dis iframe {
            width: 100%;
            height: 400px;
        }

        .video-li {
            flex: 3.5;
            display: flex;
            padding: var(--b-pad);
            border-radius: 3px;
            flex-direction: column;
            background: var(--primary);
        }

        .li-collapsed {
            overflow: hidden;
            height: 40px;
        }

        #vli-info {
            flex: 3;
            padding: 0 var(--b-pad) 0 var(--b-pad);
        }

        #upper-info {
            display: flex;
        }

        #li-titles {
            flex: 9;
        }

        #li-titles div {
            padding-bottom: 5px;
        }



        #lower-info {
            display: flex;
            padding-top: var(--b-pad);
        }

        #lower-info div {
            width: 40px;
            height: 40px;
            cursor: pointer;
        }


        #vli-videos {
            flex: 7;
            overflow: auto;
        }

        .video-con {
            display: flex;
            cursor: pointer;
            padding: var(--s-pad);
            column-gap: var(--s-pad);
            margin-bottom: var(--b-pad);
        }

        .video-con:hover,
        .active-con {
            background: var(--active);
        }

        .index {
            min-width: 15px;
            align-self: center;
        }

        .thumb {
            width: 100px;
            height: 60px;
            background: var(--secondary);
            align-items: center;
        }

        .thumb iframe {
            align-items: center;
            height: 60px;
            width: 95px;
            margin-right: 1rem;
        }

        .v-titles {
            flex: 6;
            padding: 20px;
        }

        .v-titles a div:nth-child(2) {
            margin-top: var(--s-pad);
        }

        @media only screen and (max-width: 1150px) {
            #playlist {
                width: 95vw;
                height: 60vh;
            }
        }

        @media only screen and (max-width: 950px) {
            #playlist {
                top: 10%;
                width: 50vw;
                margin: 0 auto;
                display: block;
                align-items: center;
                transform: translate(-50%, 0%);
            }

            #video-dis {
                margin-bottom: var(--b-pad);
                width: 100%;
                height: 300px;
            }
        }

        @media only screen and (max-width: 800px) {
            #playlist {
                width: 60vw;
            }
        }

        @media only screen and (max-width: 650px) {
            #playlist {
                width: 80vw;
                padding-top: 20px;
            }

            .video-li {
                flex: 3.5;
                display: block;
                padding: var(--b-pad);
                border-radius: 3px;
                flex-direction: column;
                background: var(--primary);
                margin-top: 100px;
            }
        }
    </style>

</main>
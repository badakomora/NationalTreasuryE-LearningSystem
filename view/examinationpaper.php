<?php require_once("header.php"); ?>
<main>


    <div class="container-fluid" style="font-family:georgia;">
        <div class="jumbotron p-5">
            <div class="container mt-sm-5 my-1 shadow-lg bg-white rounded">
                <div class="question ml-sm-5 pl-sm-5 pt-2">
                    <div style="display:flex;justify-content:space-between;">
                        <h1>Final Examination.</h1>
                        <p style="padding-top:15px;"><b id="time"></b>mins</p>
                    </div>
                    <hr>
                    <form action="./?q=FinalResults" method="POST" id="exam" runat="server">

                        <?php
                        $query = mysqli_query($con, "SELECT final_exam.id as feid, final_exam.question, final_exam.course_id, final_exam.option1, final_exam.option2, final_exam.option3, final_exam.option4, courses.id as cid
                          FROM final_exam
                          INNER JOIN courses ON final_exam.course_id=courses.id WHERE final_exam.course_id= '" . $_GET['course'] . "'
                          ");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>



                            <div class="py-2 h5"><b>Q <?php echo $no; ?>. <?php echo $row['question']; ?> </b></div>
                            <br>
                            <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options" style="padding:10px;">

                                <input type="hidden" name="id" value="<?php echo $row['cid'] ?>">
                                <label class="options"><?php echo $row['option1'] ?> <input type="radio" name="answer[<?php echo $no; ?>]" id="answer" value="1"> <span class="checkmark"></span> </label>
                                <label class="options"><?php echo $row['option2'] ?> <input type="radio" name="answer[<?php echo $no; ?>]" id="answer" value="2"> <span class="checkmark"></span> </label>
                                <label class="options"><?php echo $row['option3'] ?> <input type="radio" name="answer[<?php echo $no; ?>]" id="answer" value="3"> <span class="checkmark"></span> </label>
                                <label class="options"><?php echo $row['option4'] ?> <input type="radio" name="answer[<?php echo $no; ?>]" id="answer" value="4"> <span class="checkmark"></span> </label>
                            </div>
                </div>



            <?php $no++;
                        } ?>


            <button class="submit" name="submit" id="submit">Submit</button>
            <style>
                .submit {
                    color: white;
                    background-color: #031d69;
                    border-radius: 10px;
                    width: 100px;
                    height: 40px;
                    border: none;
                }
            </style>
            </form>
            <script>
                function startTimer(duration, display) {
                    var timer = duration, minutes, seconds;
                    if (typeof(localStorage.getItem('examtime')) != 'object') {
                        timer = parseInt(localStorage.getItem('examtime'));
                    }
                    setInterval(function() {
                        localStorage.setItem('examtime', timer);
                        minutes = parseInt(timer / 60, 10)
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        display.textContent = minutes + ":" + seconds;

                        if (timer-- < 0) {
                            document.getElementById('submit').click();
                            clearInterval(timer);
                            localStorage.removeItem('examtime', timer);
                        }
                    }, 1000);
                }

                window.onload = function() {
                    var fiveMinutes = 60 * 90,
                    display = document.querySelector('#time');
                    startTimer(fiveMinutes, display);
                };
            </script>
            </div>
        </div>
    </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            background-color: white;
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

        .question {
            width: 75%
        }

        .options {
            position: relative;
            padding-left: 40px;
        }

        #options label {
            display: block;
            margin-bottom: 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .options input {
            opacity: 0
        }

        .checkmark {
            position: absolute;
            top: -1px;
            left: 0;
            height: 25px;
            width: 25px;
            /* background-color:#1977cc; */
            background: white;
            border: 2px solid #ddd;
            border-radius: 50%;
        }

        .options input:checked~.checkmark:after {
            display: block
        }

        .options .checkmark:after {
            content: "";
            width: 10px;
            height: 10px;
            display: block;
            /* background: #1977cc; */
            background: black;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s;
        }

        .options input[type="radio"]:checked~.checkmark {
            background: white;
            transition: 300ms ease-in-out 0s;
        }

        .options input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1);
        }

        @media(max-width:576px) {
            .question {
                width: 100%;
                word-spacing: 2px;
            }
        }
    </style>

</main>
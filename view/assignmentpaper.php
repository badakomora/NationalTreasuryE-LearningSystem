<?php require_once("header.php");?>
<main>





                <div class="container-fluid" style="font-family:georgia;">
                       <div class="jumbotron p-5">
                            <div class="container mt-sm-5 my-1 shadow-lg bg-white rounded">
                                <div class="question ml-sm-5 pl-sm-5 pt-2">
                                    <h1>Assignment </h1>
                                    <form action="./?q=Results" method="POST">

                    <?php
                    $query = mysqli_query($con, "SELECT lessons.id as lid, assignments.lesson_id, assignments.question, assignments.option1, assignments.option2, assignments.option3, assignments.option4
                    FROM lessons
                    INNER JOIN assignments ON assignments.lesson_id = lessons.id WHERE assignments.lesson_id = '".$_GET['lesson']."'
                    ");
                    $no = 1;
                    while($row = mysqli_fetch_assoc($query)){
                    ?>



                                  <div class="py-2 h5"><b>Q <?php echo $no;?>. <?php echo $row['question']; ?> </b></div>
                                    <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">  
                                          
                                            <input type="hidden" name="id" value="<?php echo $row['lid']?>">
                                            <label class="options"><?php echo $row['option1']?> <input type="radio" name="answer[<?php echo $no;?>]" id="answer" value="1" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $row['option2']?> <input type="radio" name="answer[<?php echo $no;?>]" id="answer" value="2" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $row['option3']?> <input type="radio" name="answer[<?php echo $no;?>]" id="answer" value="3" > <span class="checkmark"></span> </label> 
                                            <label class="options"><?php echo $row['option4']?> <input type="radio" name="answer[<?php echo $no;?>]" id="answer" value="4" > <span class="checkmark"></span> </label>

                                    </div>
                                  </div>



                    <?php $no++; }?>

                                    <button class="submit" type="submit" name="submit">Submit</button>
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
    background:white;
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
    background:black;
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
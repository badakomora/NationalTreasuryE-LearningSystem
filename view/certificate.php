<?php require_once("header.php");?>
<main>



<button onclick="printDiv();" class="brp-blue-header" style="width:120px; height: 40px; border:none;background-color:#1D2231; color:white;border-radius:10px;">Print <i class="fa fa-print"></i> </button>



<script>
        function printDiv(){
            var Content = document.getElementById("GFG").innerHTML;
            var a = window.open('', '');
            a.document.write('<html><head><title></title>');
            a.document.write('<link rel="stylesheet" href="tools/css.css" type="text/css" />');
            a.document.write('</head><body >');
            a.document.write('<center>');
            a.document.write(Content);
            a.document.write('</center>');
            a.document.write('</body></html>');
            a.document.close();
            setTimeout(function () {
                window.frames["div"].focus();
                window.frames["div"].print();
                frame1.remove();
            }, 500);
            a.print(Content);
        }
</script> 




<center>
<div class="certificate-container" id="GFG" >
    <div class="certificate" style="background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQ-wYeYnqHH8NxJ_2ZGbU-izQATgzuggBwfbV-sAhiw8bs8nUx0p5qrk7rwsWvu0mG6as&usqp=CAU'); background-repeat:no-repeat; background-size:cover;position: absolute;background-position: center;">
        <div class="water-mark-overlay"></div>
        <div class="certificate-header">
            CERTIFICATE OF COMPLETION
            <h1>Learn</h1>
        </div>
        <div class="certificate-body">
           
            <p class="certificate-title"><strong>This is to certify that</strong></p>
            <br>
           <i> <h1 class="title"><?php echo $_SESSION['firstname']. ' ' .$_SESSION['lastname']; ?></h1></i>
           <br> 
           <p class="student-name"></p>
            <div class="certificate-content">
                <div class="about-certificate">
                <p>
                    having satisfied all the requirements for the award of certificate in
                </p>

                </div>
                <br>
                <h1 class="student-name">
                     <?php 
                        $courses = mysqli_query($con, "SELECT * FROM courses WHERE id='".$_GET['course']."'");
                        while($row = mysqli_fetch_array($courses)){
                            echo $row['course'];
                        }
                     ?>
                </h1>

                <?php 
                $award = mysqli_query($con, "SELECT * FROM final_results WHERE course_id='".$_GET['course']."' AND user_id='".$_SESSION['user_id']."'");
                while($row = mysqli_fetch_array($award)){
                    if($row['marks'] >= 75){
                        echo '<p><i>Distinction</i></p>';
                    }elseif(($row['marks'] >= 50) AND ($row['marks'] <= 74 )){
                        echo '<p><i>Credit</i></p>';
                    }else{
                        echo '<p><i>Pass</i></p>';
                    }
                }
                ?>
      <br>
                <p class="topic-title">
                    was awarded this Certicate at a congregation held at the National Treasury <br> State Department of Planning 
                </p>
               
                <div class="text-center">
                    <p class="topic-description text-muted">We celebrate your good effort and thank you for your full cooperation. Congratulation.</p>
                </div>
            </div>
            <br>
            <div class="certificate-footer text-muted">
                <div class="row">
                    <i>
                    <div class="col-md-6">
                        <p>Endorsed by: ______________________</p>
                    </div>
                    <div class="col-md-6">
                        <p> Accredited by: ______________________</p>
                    </div>
                    <div class="col-md-6">
                        <p>HEAD OF DEPARTMENT: ______________________</p>
                    </div>
                    </i>
                    <br>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                   Congratulations <?php echo $_SESSION['firstname']. ' ' .$_SESSION['lastname']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</center>
<style>
   .certificate-container {
    padding: 50px;
    width: 950px;
    height:1000px;
  }
  .certificate {
    border: 20px solid #0C5280;
    padding: 25px;
    height: 800px;
    background-position: center;
    background-repeat:no-repeat; 
    background-size:cover;
    position: absolute;
    /* background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQ-wYeYnqHH8NxJ_2ZGbU-izQATgzuggBwfbV-sAhiw8bs8nUx0p5qrk7rwsWvu0mG6as&usqp=CAU'); */
  }
  
  .certificate:after {
    content: '';
    top: 0px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    position: absolute;
    /* background-image: url("https://previews.123rf.com/images/kjpargeter/kjpargeter1105/kjpargeter110500001/9478700-fondo-de-certificado-decorativos-con-marca-de-agua-en-el-centro.jpg"); */
    background-size: 100%;
    z-index: -1;
  }
  
  .certificate-header > .logo {
    width: 80px;
    height: 80px;
  }
  
  .certificate-title {
    text-align: center;    
  }
  
  .certificate-body {
    text-align: center;
  }
  
  .title {
  
    font-weight: 400;
    font-size: 48px;
    color: #0C5280;
  }
  
  .student-name {
    font-size: 24px;
  }
  
  .certificate-content {
    margin: 0 auto;
    width: 750px;
  }
  
  .about-certificate {
    width: 380px;
    margin: 0 auto;
  }
  
  .topic-description {
  
    text-align: center;
  }
</style>





</main>




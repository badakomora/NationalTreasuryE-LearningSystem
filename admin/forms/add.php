<?php require_once("admin/header.php");?>
<main>

<?php if (isset($_GET['q']) AND $_GET['q'] == 'AddDepartment'){?>

<!-- Add dept -->

<?php
if(isset($_POST['adddepartment'])){
$msg='';
$department = $_POST['department'];
$dept = mysqli_query($con, "SELECT * FROM departments WHERE department = '$department'");
$deptrows = mysqli_num_rows($dept);
    if($deptrows >= 1){
        $msg = "Department Already Exists!";
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }else{
            $query = mysqli_query($con, "INSERT INTO departments(department) VALUES('$department')");
            if($query){
            $msg = "Department Added successfully!";
            echo "<script type='text/javascript'>alert('$msg');</script>";
            }else{
            $msg = "An error Occurred. Please Try again!";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }
}
?>









                                <form action="" method="POST">
                                    
                                    <div><b>Add Department</b></div>

                                    <div>  
                                        
                                        <label>Department Name.</label>
                                        <input type="text"  name="department" required>
                                       
                                        <button class="add" name="adddepartment" type="submit">Add</button>
                                        
                                    </div>
                                </form>

                                <br>
                                <hr>


<?php }else{
     $msg = "An Error ocuured! Please try again!";
     echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminDashboard';
            </script>";
 }?>

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
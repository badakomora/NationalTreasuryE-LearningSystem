<?php require_once("admin/header.php");?>
<main>

<?php if (isset($_GET['q']) AND $_GET['q'] == 'EditDepartment'){?>

<!-- edit department -->

<?php
if(isset($_POST['editdepartment'])){
$msg="";
$department = $_POST['department'];
$did = $_GET['id'];
$query =mysqli_query($con, "UPDATE departments SET department = '$department' WHERE id = '$did'");
    if($query){
    $msg = "Department Updated Successfully!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
    }else{
    $msg = "An error Occurred. Please Try again!";
    echo "<script type='text/javascript'>alert('$msg');</script>";
    }
}
?>







                                <form action="" method="POST">
                                    
                                    <div><b>Update Department</b></div>

                                    <div>  
                                        
                                        <label>Department Name.</label>
                                        <?php
                                        $dept = mysqli_query($con, "SELECT * FROM departments WHERE id = '".$_GET['id']."'");
                                        while($deptrows = mysqli_fetch_array($dept)){?>
                                        <input type="text"  name="department" value="<?php echo $deptrows['department']; ?>">
                                        <?php }?>
                                        <button class="add" name="editdepartment" type="submit">Update</button>
                                        
                                    </div>
                                </form>

                                <br>
                                <hr>






<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'EditRole'){?>


<?php
if(isset($_POST['updaterole'])){
$staff = $_POST['staff'];
$uid = $_POST['uid'];
$did =$_POST['did'];
$mg ='';
$query = mysqli_query($con, "UPDATE users SET staff = '$staff' WHERE id = '$uid'");
if($query){
$query1 = mysqli_query($con, "SELECT * FROM users WHERE staff = '$staff'");
while ($a = mysqli_fetch_array($query1)) {
      $query2 = mysqli_query($con, "SELECT * FROM faculty WHERE user_id = '$uid' AND d_id ='$did'");
      $num = mysqli_num_rows($query2);
      if($num >= 1){
        mysqli_query($con, "UPDATE faculty SET d_id = '$did' WHERE user_id = '$uid'");
      }else {
        $query3 = mysqli_query($con, "SELECT * FROM faculty WHERE user_id = '$uid'");
        $num1 = mysqli_num_rows($query3);
        if($num1 >= 1){
          mysqli_query($con, "UPDATE faculty SET d_id = '$did' WHERE user_id = '$uid'");
        }else {
          $query4 = mysqli_query($con, "SELECT * FROM faculty WHERE d_id = '$did'");
          $num2 = mysqli_num_rows($query4);
          if($num2 >= 1){
            mysqli_query($con, "UPDATE faculty SET user_id = '$uid' WHERE d_id = '$did'");
          }else{
            mysqli_query($con, "INSERT INTO faculty(user_id, d_id) VALUE('$uid','$did')");
          }
      }
    }
  }
}
  $msg = "Records updated Successfully.";
  echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminUsers';
            </script>";

}
?>




                                <form action="" method="POST">
                                    
                                    <div><b>Update User Role</b></div>

                                    <div>  
                                       <?php
                                       $query = mysqli_query($con, "SELECT * FROM Users WHERE id = '".$_GET['id']."'");   
                                       while($row = mysqli_fetch_array($query)){        
                                       ?> 
                                      
                                        <label>User Email.</label>
                                        <input type="text" name="email" value="<?php echo $row['email'];?>" style="cursor: no-drop;">
                                        <label>User Role.</label>
                                        <select name="staff" id="hide" onchange="showDiv(this)" style="width: 100%; height:50px">
                                            <option value="1">Update role or status</option>
                                            <option value="0">Faculty Admin</option>
                                            <option value="1">Normal User</option>
                                            <option value="2">Deactivate Account</option> 
                                        </select>
                                        <br><br>
                                        <div id="hidden_div" style="display:none;">
                                        <select name="did" style="height: 50px;width:100%;">
                                          <option>Assign Department.</option>
                                          <?php 
                                          $query = mysqli_query($con, "SELECT * FROM departments");
                                          while($row  = mysqli_fetch_array($query)){ ?>
                                              <option value="<?php echo $row['id'] ?>"><?php echo $row['department']?></option>
                                          <?php }?>
                                        </select>
                                        </div>
                                        <script type="text/javascript">
                                        function showDiv(select){
                                          if(select.value==0){
                                            document.getElementById('hidden_div').style.display = "block";
                                          } else{
                                            document.getElementById('hidden_div').style.display = "none";
                                          }
                                        } 
                                        </script>
                                        <input type="hidden" name="uid" value="<?php echo $_GET['id'];?>">
                                        <br><br>
                                        <button class="add" name="updaterole" type="submit">Update</button>
                                        <?php }?>
                                    </div>
                                </form>

                                <br>
                                <hr>












<?php }elseif(isset($_GET['q']) AND $_GET['q'] == 'UpdatePassword'){?>





<?php  
if(isset($_POST['updateuser'])){   

    $id = $_GET['id'];
    $password = $_POST['password'];
    $query =mysqli_query($con, "UPDATE admin SET password ='$password' WHERE id='$id' ");
        if($query){
            $msg = "Password updated Successfully!Please Sign In with the new Pasword.";
            echo "<script type='text/javascript'>
                alert('$msg');
                window.location = 'admin/includes/logout.php';
            </script>";

        }else{
            $msg = "An Error ocuured! Please try again!";
            echo "<script type='text/javascript'>
                alert('$msg');
                window.location = './?q=AdminDashboard';
            </script>";
        }
}
?>



                                <form action="" method="POST">
                                    
                                    <div><b>Update User Password</b></div>

                            
                                        <label>Password.</label>
                                        <input type="text"  name="password" required placeholder="Do not quote or use apostrophe">
                                        <button class="add" type="submit" name="updateuser">Update</button>
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
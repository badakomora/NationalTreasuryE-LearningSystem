<?php
session_start();
include_once 'includes/config.php';
$status = $_POST['status'];
$lesson = $_POST['lesson'];
$query = mysqli_query($con, "UPDATE assignments_done SET status = '$status' WHERE user_id = '".$_SESSION['user_id']."' AND lesson_id = '$lesson'");
$msg = "You have successfully unlock the Lesson assignment. You can now Attempt the assignment!";
echo "<script type='text/javascript'>alert('$msg');</script>";
header("refresh: 0,./?q=Lecture&lesson=$lesson");
?>
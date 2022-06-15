<?php
if(!isset($_SESSION['email'])) {
header("refresh: 0, ./admin/");
$msg = "Please Sign In Correctly or your Account will be De-activated Completely!";
echo "<script type='text/javascript'>alert('$msg');</script>";

}

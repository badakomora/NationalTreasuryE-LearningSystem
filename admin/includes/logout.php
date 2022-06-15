<?php
session_start();
unset($_SESSION["email"]);
session_destroy();
header("refresh: 0, ../");
$msg = "Sign out Action Successful!";
echo "<script type='text/javascript'>alert('$msg');</script>";

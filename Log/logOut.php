<?php
$_SESSION['loggedin']=false;
session_start();
session_unset();
session_destroy();
header("location:logIn.php?msg=Logout Successfull");
?>
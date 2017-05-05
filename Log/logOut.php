<?php
$_SESSION['loggedin']=false;
session_start();
session_unset();
session_destroy();
session_start();
$_SESSION['msg']="Logout Successfull";
header("location:logIn.php");
?>
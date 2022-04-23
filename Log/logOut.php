<?php
$_SESSION['loggedin']=false;
session_start();
session_unset();
session_destroy();
session_start();
$_SESSION['msg']='<div class="msg msgSuccess">Logout Successfull</div>';
header("location:logIn.php");
?>
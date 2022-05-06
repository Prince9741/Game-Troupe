<?php
session_start();
$temp=isset($_SESSION['msg'])?$_SESSION['msg']:0;
$_SESSION['loggedin']=false;
session_unset();
session_destroy();
session_start();
$_SESSION['msg']=$temp?$temp:'<div class="msg msgSuccess">Logout Successfull</div>';
header("location:logIn.php");
?>
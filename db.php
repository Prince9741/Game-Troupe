<?php
$host="localhost";
$userName="root";
$password="";
$db="scoring";
$Scoring=new mysqli($host,$userName,$password,$db);
if($Scoring->connect_error)
    die("Connection failed: ".$Scoring->connect_error);
?>
<?php
//$host="sql210.epizy.com";$userName="epiz_31223356";$password="vePANMZhasiG";$db="epiz_31223356_gameTroupe";
$host="localhost";$userName="root";$password="";$db="scoring";
$Scoring=new mysqli($host,$userName,$password,$db);
if($Scoring->connect_error)
    die("Connection failed: ".$Scoring->connect_error);
//connecting database
?>
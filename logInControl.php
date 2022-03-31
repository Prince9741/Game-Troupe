<?php
require "db.php";
if(isset($_POST['username']))
    $username=$_POST['username'];
if(isset($_POST['pwd'])){
    $pwd=$_POST['pwd'];
    $result=$Scoring->query("SELECT * FROM `players` WHERE `userName`='$username'");
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
            if($rows['Password']==$pwd){//check password is correct or not
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$rows['UserName'];
                $_SESSION['Gender']=$rows['GenderId'];//take gender value from database
                header("location:Game.php");
            }
            else
            header("location:logIn.html?msg=Wrong+Password");
    }
    else
        header("location:logIn.html?msg=$plz,+sign+up+first");
    }
?>

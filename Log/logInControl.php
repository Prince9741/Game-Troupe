<?php
require "../db.php";
if(isset($_POST['username']) && isset($_POST['pwd'])){
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    $result=$Scoring->query("SELECT * FROM `Players` WHERE `userName`='$username'");//find the user data
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
            if($rows['Password']==$pwd){//check password is correct or not
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['userId']=$rows['UserId'];
                $_SESSION['username']=$rows['UserName'];
                $_SESSION['gender']=$rows['GenderId'];//take gender value from database
                header("location:../index.php");//send to the main page
            }
            else
            header("location:logIn.php?msg=Wrong+Password");//this code run when password is wrong
    }
    else
        header("location:logIn.php?msg=Sign+up+first");//this code run when user is invalid
}
else
    header("location:logIn.php");
?>

<?php
require "../db.php";
session_start();
if(isset($_POST['userName']) && isset($_POST['pwd'])){
    $userName=$_POST['userName'];
    $pwd=$_POST['pwd'];
    $result=$Scoring->query("SELECT * FROM `Players` WHERE `userName`='$userName'");//find the user data
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
            if($rows['Password']==$pwd){//check password is correct or not
                $_SESSION['loggedin']=true;
                $_SESSION['userId']=$rows['UserId'];
                $_SESSION['userName']=$rows['UserName'];
                $_SESSION['gender']=$rows['GenderId'];//take gender value from database
                $_SESSION['profilePic']="../profilePic/".$rows['ProfilePic'];
                header("location:../index.php");//send to the main page
            }
            else
            $_SESSION['msg']='<div class="msg">Wrong Password</div>';//this code run when password is wrong
    }
    else
        $_SESSION['msg']='<a href="signUp.php" class="msg"><div>'.$userName.': Register First</div></a>';//this code run when user is invalid
}
header("location:logIn.php");
?>

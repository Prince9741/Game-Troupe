<?php 
require "../db.php";
session_start();
$control=isset($_GET['control'])?$_GET['control']:NULL;
$error=false;

if(isset($_POST['userName']) && isset($_POST['gen']))//get all fetch value
{
    $userName=$_POST['userName'];
    $gen=$_POST['gen'];
}
else if(isset($_POST['pwd']) && isset($_POST['oPwd']) && isset($_POST['cPwd'])){
    $oPwd=$_POST['oPwd'];
    $pwd=$_POST['pwd'];
    $cPwd=$_POST['cPwd'];
}
else if(isset($_POST['pwd'])){
    $pwd=$_POST['pwd'];
}
else
    header("location:profileUpdate.php");

$userId=$_SESSION['userId'];

function profileUpdate($conn){//inserting data function   
    global $userName,$gen,$error,$userId;
    $result=$conn->query("SELECT * FROM `Players` WHERE `userName`='$userName'");//find the user data
    if($_SESSION['userName']==$userName && $_SESSION['gender']==$gen){
        $_SESSION['msg']='<div class="msg msgSuccess">No Change</div>';
        $error=true;
    }
    else if($result->num_rows==1 && $_SESSION['userName']!=$userName){
        $_SESSION['msg']='<a href="#" class="msg"><div>'.$userName.': Already exist</div></a>';
        $error=true;
    }
    else{
        $sql = "UPDATE `Players` SET `UserName` = '$userName', `GenderId` = '$gen' WHERE `UserId`=$userId";
        $result= $conn->query($sql);
        if($result){
            $_SESSION['userName']=$userName;
            $_SESSION['gender']=$gen;
            $_SESSION['msg']='<div class="msg msgSuccess">Profile Update</div>';
            $error=false;
        }
        else{
            $_SESSION['msg']='<div class="msg">Something Went Wrong</div>';
        }
    }
    header("location:profileUpdate.php");
}

function changePassword($conn){//inserting data function   
    global $pwd,$cPwd,$oPwd,$error,$userId;
    $result=$conn->query("SELECT `Password` FROM `Players` WHERE `UserId`=$userId");//find the user data
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
        if($rows['Password']==$oPwd){//check password is correct or not
            if($pwd==$cPwd){//insert if password match
                $sql = "UPDATE `Players` SET `Password` = '$pwd' WHERE `UserId`=$userId";
                $result= $conn->query($sql);
                echo $_SESSION['msg']='<div class="msg msgSuccess">Password Changed</div>';
                $error=false;
            }
            else
            {
                $_SESSION['msg']='<div class="msg">Password did not match</div>';
                $error=true;
            }   
        }
        else{
            $_SESSION['msg']='<div class="msg">Wrong Password</div>';//this code run when password is wrong
            $error=true;
        }
    }
$error?header("location:changePassword.php"):header("location:profileUpdate.php");//if error occur go to signup otherwise login
}

function deleteAccount($conn){
    global $pwd,$error,$userId;
    $result=$conn->query("SELECT `Password` FROM `Players` WHERE `UserId`=$userId");//find the user data
    if($result->num_rows==1)
    {
        $rows=$result->fetch_assoc();
        if($rows['Password']==$pwd){//check password is correct or not
            $result=$conn->query("DELETE FROM `HighScore` WHERE `UserId` = $userId");//find the user data
            if($result){
                $_SESSION['msg']='<div class="msg msgSuccess">Account Deleted</div>';//account deleted
                $result=$conn->query("DELETE FROM `Players` WHERE `UserId` = $userId");//find the user data
                $error=false;
            }    
        }
        else{
            $_SESSION['msg']='<div class="msg">Wrong Password</div>';//this code run when password is wrong
            $error=true;
        }
    }
echo $_SESSION['msg'];
$error?header("location:profileDelete.php"):header("location:../log/logOut.php");//if error occur go to signup otherwise login
}

switch($control){//which function has to be execute
    case "profileUpdate":
        echo "profileUpdate";
        profileUpdate($Scoring);
        break;
    case "changePassword":
        echo "changePassword";
        changePassword($Scoring);
        break;
    case "deleteAccount":
        deleteAccount($Scoring);
        break;  
    default:
        header("location:profileUpdate.php");
}
?>
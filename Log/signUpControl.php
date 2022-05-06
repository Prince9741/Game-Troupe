<?php 
require "../db.php";
session_start();
$control="add";
$error=false;
if(isset($_POST['userName']) && isset($_POST['gen']) && isset($_POST['pwd']) && isset($_POST['cPwd']))
{
    $userName=$_POST['userName'];
    $gen=$_POST['gen'];
    $pwd=$_POST['pwd'];
    $cPwd=$_POST['cPwd'];
}//get all fetch value
else
    header("location:signUp.php");

function runQuary($conn,$sql){//to ran our query
    global $userName,$error,$pwd;
    $result=$conn->query("SELECT * FROM `Players` WHERE `userName`='$userName'");//find the user data
    if($result->num_rows==1)
    {
        $_SESSION['msg']='<a href="logIn.php" class="msg"><div>'.$userName.': Already exist</div></a>';
        $_SESSION['userNameLog']="value='$userName'";
        $error=true;
    }
    else{
        $result= $conn->query($sql);
        $error=false;
        $_SESSION['msg']='<label for="submit" ><div class="msg msgSuccess">'.$userName.': Successful Registered</div></label>';
        $_SESSION['userNameLog']="value='$userName'";
        $_SESSION['pwd']="value='$pwd'";
    }
}

function add($conn){//inserting data function   
    global $userName,$gen,$pwd,$cPwd,$error;
    if($pwd!=$cPwd){//insert if password match
        $_SESSION['msg']='<div class="msg">Password did not match</div>';
        $error=true;
    }
    else//password did not match
    {
        $sql = "INSERT INTO `Players` (`UserName`, `GenderId`, `Password`) VALUES ('$userName', '$gen', '$pwd')";
        runQuary($conn,$sql);
    }
    $error?header("location:signUp.php"):header("location:logIn.php");//if error occur go to signup otherwise login
}

switch($control){//which function has to be execute
    case "add":
        echo " Add";
        add($Scoring);
        break;
    case "remove":
        echo "Removing";
        //remove($prince);
        break;
    case "show":
        //show($prince);
        break;  
    default:
        header("location:signUp.php");
}
?>
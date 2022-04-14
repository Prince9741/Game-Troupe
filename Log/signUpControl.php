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
    global $userName,$error;
    $result=$conn->query("SELECT * FROM `Players` WHERE `userName`='$userName'");//find the user data
    if($result->num_rows==1)
    {
        $_SESSION['msg']="Already exist: $userName";
        $error=true;
    }
    else{
        $result= $conn->query($sql);
        $_SESSION['msg']="Successful Registered: $userName";
    }
}

function add($conn){//inserting data function   
    global $userName,$gen,$pwd,$cPwd,$error;
    if($pwd!=$cPwd){//insert if password match
        $_SESSION['msg']="Password did not match";
        $error=true;
    }
    else//password did not match
    {
        $sql = "INSERT INTO `Players` (`UserName`, `GenderId`, `Password`) VALUES ('$userName', '$gen', '$pwd')";
        runQuary($conn,$sql);
    }
    $error?header("location:signUp.php"):header("location:logIn.php");
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
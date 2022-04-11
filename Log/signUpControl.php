<?php 
require "../db.php";
$control="add";
if(isset($_POST['username']) && isset($_POST['gen']) && isset($_POST['pwd']) &&isset($_POST['cPwd']))
{
    $username=$_POST['username'];
    $gen=$_POST['gen'];
    $pwd=$_POST['pwd'];
    $cPwd=$_POST['cPwd'];
}//get all fetch value
else
    header("location:signUp.php");
function runQuary($conn,$sql){//to ran our query
    global $username;
    $result= $conn->query($sql);
    if(mysqli_errno($conn)==1062)
        header("location:signUp.php?msg=$username+Already+exist");
    else
        header("location:logIn.php");//login after signup
        //echo mysqli_error($conn);
}

function add($conn){//inserting data function   
    global $username,$gen,$pwd,$cPwd;
    if($pwd==$cPwd)
    {
        $sql = "INSERT INTO `Players` (`UserName`, `GenderId`, `Password`) VALUES ('$username', '$gen', '$pwd')";
        runQuary($conn,$sql);
    }
    else
        header("location:signUp.php?msg=Password+did+not+match");//password did not match
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
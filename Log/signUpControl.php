<?php 
require "../db.php";
session_start();
$control="add";
if(isset($_POST['userName']) && isset($_POST['gen']) && isset($_POST['pwd']) &&isset($_POST['cPwd']))
{
    $userName=$_POST['userName'];
    $gen=$_POST['gen'];
    $pwd=$_POST['pwd'];
    $cPwd=$_POST['cPwd'];
}//get all fetch value
else
    header("location:signUp.php");
function runQuary($conn,$sql){//to ran our query
    global $userName;
    $result= $conn->query($sql);
    if(mysqli_errno($conn)==1062)
    {
        $_SESSION['msg']="$userName Already exist";
    }
    else
        header("location:logIn.php");//login after signup
}

function add($conn){//inserting data function   
    global $userName,$gen,$pwd,$cPwd;
    if($pwd==$cPwd)
    {
        $sql = "INSERT INTO `Players` (`UserName`, `GenderId`, `Password`) VALUES ('$userName', '$gen', '$pwd')";
        runQuary($conn,$sql);
    }
    else
        $_SESSION['msg']="Password did not match";
    echo $_SESSION['msg'];
  //  header("location:signUp.php");//password did not match
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
    echo "test 3";
      //  header("location:signUp.php");      
}
?>
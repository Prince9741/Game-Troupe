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
    header("location:signUp.html");

function runQuary($conn,$sql){//to ran our query
    try{
        $result= $conn->query($sql);
            header("location:logIn.html");//login after signup
    }
    catch(mysqli_sql_exception){
        global $username;
        if(mysqli_errno($conn)==1062) //for dublicate entry error
            header("location:signUp.html?msg=$username+Already+exist");
        else
        echo $conn -> error;//this code execute if any other error occur
    }
}

function add($conn){//inserting data function   
    global $username,$gen,$pwd,$cPwd;
    if($pwd==$cPwd)
    {
    $sql = "INSERT INTO `players` (`UserName`, `GenderId`, `Password`) VALUES ('$username', $gen, '$pwd')";
    runQuary($conn,$sql);
    }
    else
    header("location:signUp.html?msg=Password+did+not+match");//password did not match
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
    header("location:signUp.html");      
}
?>
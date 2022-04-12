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
    try{
        $result= $conn->query($sql);
        echo " login.php ";
        header("location:logIn.php");//login after signup
    }
    catch(mysqli_sql_exception $err){
        echo " erro found ";
        global $userName;
        if(mysqli_errno($conn)==1062) //for dublicate entry error
            $_SESSION['msg']="Already exist: $userName";
        else{
            echo $conn -> error;//this code execute if any other error occur
            echo $err;
        }
    }
}

function add($conn){//inserting data function   
    global $userName,$gen,$pwd,$cPwd;
    if(!$pwd==$cPwd)//insert if password match
        $_SESSION['msg']="Password did not match";
    else//password did not match
    {
        $sql = "INSERT INTO `Players` (`UserName`, `GenderId`, `Password`) VALUES ('$userName', '$gen', '$pwd')";
        runQuary($conn,$sql);
        echo "query ran ";
    }
    echo " signup.php ";
    header("location:signUp.php");
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
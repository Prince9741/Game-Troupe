<?php
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);//check user loged in or not
if(!$log)
    header("location:../log/logIn.php ");
function runQuary($conn,$sql){//to ran our query
    try{
        $result= $conn->query($sql);
    }
    catch(mysqli_sql_exception){
        echo $conn -> error." ".mysqli_errno($conn) ;//this code execute if any other error occur
    }
}

//if(isset($_POST['username']) && isset($_POST['gen']) && isset($_POST['pwd']) &&isset($_POST['cPwd']))
//{
    $score=13454;//input game and user information@@@@@@@
    $userId=8;//@@@@@@@@
    $gameId=1;//@@@@@@
//}

$sql="INSERT INTO `highscore` (`Score`, `UserId`, `GameId`) VALUES ('$score', '$userId', '$gameId')";
runQuary($Scoring,$sql);
?>
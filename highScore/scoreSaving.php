<?php
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);//check user loged in or not
if(!$log)
    header("location:../log/logIn.php ");

// $score=$_GET['score'];//input game and user information@@@@@@@
// $userId=$_SESSION['userId'];//@@@@@@@@
// $gameId=$_GET['gameId'];//@@@@@@
$score=654;//input game and user information@@@@@@@
$userId=337;//@@@@@@@@
$gameId=1;//@@@@@@

$result=$Scoring->query("SELECT `ScoreType` from Game where `GameId`=$gameId");
if($result->num_rows==1){
    $row = $result->fetch_assoc();
    $lastScore=$row["ScoreType"]?"MIN(`Score`)":"MAX(`Score`)";//tell scorring type
    $result=$Scoring->query("SELECT $lastScore as lastScore FROM highscore where `GameId`=$gameId");
    if($result->num_rows==1)
        $row = $result->fetch_assoc();
}
if($lastScore=="MIN(`Score`)"){
    if($row['lastScore']<$score){
    // runQuary($Scoring,"DELETE FROM `highScore` WHERE `ScoreId` = 5");
    // $sql="INSERT INTO `highScore` (`Score`, `UserId`, `GameId`) VALUES ('$score', '$userId', '$gameId')";
    // runQuary($Scoring,$sql);
    echo "Maxium: Last ".$row['lastScore']." New".$score;
    $result=$Scoring->query("SELECT * FROM highscore where `GameId`=$gameId");
    if($result->num_rows==1)
        $row = $result->fetch_assoc();
    }
}
else if($lastScore=="MAX(`Score`)"){
    if($row['lastScore']>$score){
        // runQuary($Scoring,"DELETE FROM `highScore` WHERE `ScoreId` = 5");
        // $sql="INSERT INTO `highScore` (`Score`, `UserId`, `GameId`) VALUES ('$score', '$userId', '$gameId')";
        // runQuary($Scoring,$sql);
        echo "Minimum: ".$row['lastScore']." New".$score;
    }
}

else
    echo "no need";
?>
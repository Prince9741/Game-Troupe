<?php
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);//check user loged in or not
if(!$log)
    header("location:../log/logIn.php ");

$score=$_GET['score'];//input game and user information@@@@@@@
$userId=$_SESSION['userId'];//@@@@@@@@
$gameId=$_GET['gameId'];//@@@@@@

function insert(){
    global $Scoring,$score,$userId,$gameId;
    $Scoring->query("INSERT INTO `HighScore` (`Score`, `UserId`, `GameId`) VALUES ('$score', '$userId', '$gameId')");//insert new data
}

$result=$Scoring->query("SELECT `Score` FROM `HighScore` where `GameId`=$gameId");
if($result->num_rows<7){//new seven entries
    insert();
    echo "New Score is ".$score." Game id is ".$gameId;            
}
else{//if Entries more than 7 than delete the last entry
    $result=$Scoring->query("SELECT `ScoreType` from Game where `GameId`=$gameId");//find the Score saving type of game
    if($result->num_rows==1)
    {
        $row = $result->fetch_assoc();
        $minMax=$row["ScoreType"]?"MIN(`Score`)":"MAX(`Score`)";//tell scorring type
        $result=$Scoring->query("SELECT $minMax AS lastScore FROM HighScore where `GameId`=$gameId");//find the last score of that game
        if($result->num_rows==1)
        {
            $row = $result->fetch_assoc();
            $lastScore=$row['lastScore'];
            if(($minMax=="MIN(`Score`)" && $lastScore<$score)||($minMax=="MAX(`Score`)" && $lastScore>$score))
            {//check the new score is making the position in top 7 or not
                $result=$Scoring->query("SELECT `scoreId` FROM HighScore where `GameId`=$gameId AND `Score`=$lastScore LIMIT 1");//find scoreId of lastScore
                if($result->num_rows==1)
                {
                    $id = $result->fetch_assoc();
                    $deleteEntryId=$id['scoreId'];
                    $result=$Scoring->query("DELETE FROM `HighScore` WHERE `ScoreId` = $deleteEntryId");//delete last entry via scoreId
                    insert();
                    echo "$minMax: Last Score ".$row['lastScore']." and id is ".$id['scoreId']." New Score is ".$score;
                }
            }
            else
            echo "No need for $score is too low and $minMax";
        }
    }
}
?>

<?php
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);//check user loged in or not
if(!$log)
    header("location:../log/logIn.php ");

$score=$_GET['score'];//input game and user information@@@@@@@
$userId=$_SESSION['userId'];//@@@@@@@@
$gameId=$_GET['gameId'];//@@@@@@

$result=$Scoring->query("SELECT `ScoreType` from Game where `GameId`=$gameId");//find the Score saving type of game
if($result->num_rows==1)
{
    $row = $result->fetch_assoc();
    $minMax=$row["ScoreType"]?"MIN(`Score`)":"MAX(`Score`)";//tell scorring type
    $result=$Scoring->query("SELECT $minMax as lastScore FROM highScore where `GameId`=$gameId");//find the last score of that game
    if($result->num_rows==1)
    {
        $row = $result->fetch_assoc();
        $lastScore=$row['lastScore'];
        if(!$lastScore && $minMax=="MAX(`Score`)")$lastScore=100000;//Special case for revert highscore
        if(($minMax=="MIN(`Score`)" && $lastScore<=$score)||($minMax=="MAX(`Score`)" && $lastScore>=$score))
        {
            $result=$Scoring->query("INSERT INTO `highScore` (`Score`, `UserId`, `GameId`) VALUES ('$score', '$userId', '$gameId')");//insert new data
            $result=$Scoring->query("SELECT `Score` FROM highScore where `GameId`=$gameId");
            if($result->num_rows>7)
            {//if Entries more than 7 than delete the last entry
                $result=$Scoring->query("SELECT `scoreId` FROM highScore where `GameId`=$gameId AND `Score`=$lastScore LIMIT 1");//find scoreId of lastScore
                if($result->num_rows==1)
                {
                    $id = $result->fetch_assoc();
                    $deleteEntryId=$id['scoreId'];
                    $result=$Scoring->query("DELETE FROM `highScore` WHERE `ScoreId` = $deleteEntryId");//delete last entry via scoreId
                    echo "$minMax: Last Score ".$row['lastScore']." and id is ".$id['scoreId']." New Score is ".$score;
                }
            }
            else{
                echo "New Score is ".$score." for game id ".$gameId;
            }
        }
        else
        echo "No need for $score is too low and $minMax";
    }
}
?>

    
<?php // joing query to fetch the data
require "../db.php";
session_start();
$log=isset($_SESSION['loggedin']);
$player=$log?$_SESSION['userName']:NULL;
$gameId=isset($_GET['gameId'])?$_GET['gameId']:2;//put the game id to show the highscore
$result=$Scoring->query("SELECT `ScoreType` from Game where `GameId`=$gameId");
if($result->num_rows==1)
    $row = $result->fetch_assoc();
$order=$row["ScoreType"]?"DESC":"ASC";//tell scorring type
$result=$Scoring->query("SELECT P.`UserName`, H.`Score`,H.`Date`,G.`ScoreType`,
CASE
WHEN P.`GenderId`= 0 THEN 'male'
WHEN P.`GenderId`= 1 THEN 'female'
WHEN P.`GenderId`= 2 THEN 'others'
END as rowColor FROM `HighScore` H 
LEFT JOIN `Players` P ON H.`userId`=P.`userId` 
LEFT JOIN `Game` G ON H.`GameId`=G.`GameId` 
WHERE H.`GameId`= $gameId ORDER BY H.`Score` $order");
if ($result && $result->num_rows > 0)
    for($i=1;$row = $result->fetch_assoc();$i++){//tell the user gender
        if($player==$row["UserName"])
            $row["UserName"]="You";
        echo"<tr ondblclick='specificEntry(this)' class='".$row["rowColor"]."'>
        <td>".$row["UserName"]."</td>
        <td>".$row["Score"]."</td>
        <td>".date("d-M-y", strtotime($row["Date"]))."</td>
        </tr>
        ";
    }
else
echo"<tr>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
</tr>";//print all the entry
?>
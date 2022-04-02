    
<?php // joing query to fetch the data
require "../db.php";
if(isset($_GET['e']))
$gameId=$_GET['e'];
else
$gameId=3;//put the game id to show the highscore@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$result=$Scoring->query("SELECT `scoreType` from game where `gameId`=$gameId");
$row = $result->fetch_assoc();
$order=$row["scoreType"];
echo $order=$order?"ASC":"DESC";//tell scorring type

$result=$Scoring->query("SELECT `userName`,`score`,`date`,`gameName`, `scoreType`,CASE
WHEN P.`genderId`=0 THEN 'Male'
WHEN P.`genderId`=1 THEN 'Female'
WHEN P.`genderId`=2 THEN 'Others'
END as gender from highscore H LEFT JOIN `players` P ON h.`UserId`=P.`UserId` LEFT JOIN `game` G on H.`GameId`=G.`GameId` where H.`GameId`=$gameId ORDER BY `score` $order");
if ($result && $result->num_rows > 0)
for($i=1;$row = $result->fetch_assoc();$i++){
$gender=$row["gender"];//tell the user gender
echo"<tr ondblclick='specificEntry(this)' class='".$gender."'>
<td>".$row["userName"]."</td>
<td>".$row["score"]."</td>
<td>".$row["gameName"]."</td>
<td>".$row["scoreType"]."</td>
<td>".date("d-M-y", strtotime($row["date"])).strftime('%I:%M %p',strtotime($row["date"]))."</td>
</tr>
</br>";}
else
echo"<tr>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
</tr>";  
    //print all the entry
    ?> 


    
<?php // joing query to fetch the data
require "../db.php";
if(isset($_GET['gameId']))
$gameId=$_GET['gameId'];
else
$gameId=2;//put the game id to show the highscore@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$result=$Scoring->query("SELECT `scoreType` from game where `gameId`=$gameId");
$row = $result->fetch_assoc();
$order=$row["scoreType"]?"ASC":"DESC";//tell scorring type

$result=$Scoring->query("SELECT `userName`,`score`,`date`, `scoreType`,CASE
WHEN P.`genderId`=0 THEN 'male'
WHEN P.`genderId`=1 THEN 'female'
WHEN P.`genderId`=2 THEN 'others'
END as gender from highscore H LEFT JOIN `players` P ON h.`UserId`=P.
`UserId` LEFT JOIN `game` G on H.`GameId`=G.`GameId` 
where H.`GameId`=$gameId ORDER BY `score` $order LIMIT 7");
if ($result && $result->num_rows > 0)
for($i=1;$row = $result->fetch_assoc();$i++){
//tell the user gender
echo"<tr ondblclick='specificEntry(this)' class='".$row["gender"]."'>
<td>".$row["userName"]."</td>
<td>".$row["score"]."</td>
<td>".date("d-M-y", strtotime($row["date"]))."</td>
</tr>
";}
else
echo"<tr>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
    <td>No Record</td>
</tr>";  
    //print all the entry
?> 


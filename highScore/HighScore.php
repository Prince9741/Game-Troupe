    
<?php // joing query to fetch the data
require "../db.php";
$gameId=3;//change game by change this no.
$result=$Scoring->query("SELECT `userName`,`score`,`gameName`, `scoreType`,`date`,`scoreType`, from highscore H LEFT JOIN `players` P ON h.`UserId`=P.`UserId` LEFT JOIN `game` G on h.`GameId`=G.`GameId` WHERE G.`GameId`=$gameId");
if ($result && $result->num_rows > 0)
for($i=1;$row = $result->fetch_assoc();$i++){
//$color=$row["action"]=="Issued"?'issue':'return';
$color=1;
echo"<tr ondblclick='specificEntry(this)' class='".$color."'>
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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="../allFileJs.js"></script>
</head>
<body>
    <select id="flavours"> 
<?php
require "../db.php";
$gameId=3;//put the game id to show the highscore@@@@@@@@@@@@@@@@@@@@@@@@@@@@
$result=$Scoring->query("SELECT gameName,gameId from game order by gameId");
if ($result && $result->num_rows > 0)
for($i=1;$row = $result->fetch_assoc();$i++){
    echo "<option value='".$row['gameId']."' >".$row['gameName']."</option>
    ";
}
?>
    </select>
    <div id="score">
        <?php require "highScore.php";?>
    </div>
</body>
</html>
<script>
      document.addEventListener('DOMContentLoaded', () => {
        document
          .getElementById('flavours')
          .addEventListener('input', handleSelect);
      });

      function handleSelect(ev) {
        let select = ev.target; //document.getElementById('flavours');
        url="highScore.php?gameId="+select.value;
        loadDoc(url,"score");
      }
</script>
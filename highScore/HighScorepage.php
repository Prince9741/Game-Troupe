<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="icon" href="../images/logo.png">
        <link rel="stylesheet" href="../head-foot.css">
        <script src="../allFileJs.js"></script>
</head>
<body>
<header>
        <nav class="flex" id="navbar">
            <div class=""><a href="#"><img src="../images/logo.png"></a></div><!--go to highScore page -->
            <div id="title"><a href="#">Game-Troupe</a></div>
        </nav>
    </header>
    <select id="flavours"> 
<?php
require "../db.php";
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
    <footer class="flex" id="footer">
        <div><a href="../log/signUp.html" class="button">Sign Up</a></div><!--go to highScore page -->
        <div><a href="../log/logIn.html" class="button">Login</a></div><!-- go to login up page -->
    </footer>
</body>
</html>
<script>
      document.addEventListener('DOMContentLoaded', () => {
        document
          .getElementById('flavours')
          .addEventListener('input', ev=>{
        let select = ev.target; //document.getElementById('flavours');
        url="highScore.php?gameId="+select.value;
        loadDoc(url,"score");
      });
      });
</script>
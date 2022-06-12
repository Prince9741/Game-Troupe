<?php
session_start();
$log=isset($_SESSION['loggedin']);
if(!$log)
    header("location:../log/logIn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flappy Bird-<?php echo $_SESSION['userName'];?></title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../head-foot.css">
    <link rel="stylesheet" href="../allGame.css">
    <script src="../allFileJs.js"></script>
</head>
<body>
    <?php $page="Flappy Bird"; require "../header.php";?>
    <div id="container" value="canvas">
        <canvas style="display:block" id="canvas1"></canvas>
        <div id="instructions" style="display:none"></div>
    </div>
    <footer class="flex" id="footer">
        <div><a href="../index.php" class="button">Back</a></div>
        <!--go to highScore page -->
        <div class="button" id="instructionsButton">Instructions</div>
        <div class="button" id="pausePlay">Pause/Play</div>
    </footer>
</body>
</html>
<script src="app.js"></script>
